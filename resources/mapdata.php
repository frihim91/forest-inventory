<?php
/*
 * Title:   MySQL Points to GeoJSON
 * Notes:   Query a MySQL table or view of points with x and y columns and return the results in GeoJSON format, suitable for use in OpenLayers, Leaflet, etc.
 * Author:  Bryan R. McBride, GISP
 * Contact: bryanmcbride.com
 * GitHub:  https://github.com/bmcbride/PHP-Database-GeoJSON
 */

# Connect to MySQL database
$conn = new PDO('mysql:host=192.168.0.201;dbname=faobd_db_v2','maruf','maruf');

# Build SQL SELECT statement including x and y columns
// $sql = "SELECT * FROM (SELECT x.latitude y, y.longitude x, y.total_species, x.species_desc,x.speciesId,x.fao_biome,x.output
//   FROM (SELECT   d.latitude, group_concat(d.species_desc) species_desc,d.fao_biome,d.speciesId,d.output
//             FROM (SELECT   b.latitude,b.species speciesId,b.fao_biome,b.output,
//                            CONCAT (a.species , ' (' , count(b.species)
//                            , ') ') species_desc
//                       FROM species a, ae b
//                      WHERE a.id_species = b.species and b.latitude>0
//                   GROUP BY a.species, b.latitude) d
//         GROUP BY d.latitude) x,
//        (SELECT   c.latitude, c.longitude, count(c.species) total_species
//             FROM ae c
//         GROUP BY c.latitude, c.longitude) y
//  WHERE x.latitude = y.latitude) m";
$sql = "SELECT a.latDD y,a.longDD x,GROUP_CONCAT(DISTINCT(c.output)) OUTPUT,GROUP_CONCAT(DISTINCT(FAOBiomes)) fao_biome, COUNT(FAOBiomes) total_species,
fnc_ae_species_data(a.LatDD,a.LongDD) species_desc FROM location a
LEFT JOIN group_location b ON a.ID_Location=b.location_id
LEFT JOIN ae c ON b.group_id=c.location_group
LEFT JOIN species d ON c.Species=d.ID_Species
LEFT JOIN faobiomes e ON a.ID_FAOBiomes=e.ID_FAOBiomes
WHERE c.ID_AE IS NOT NULL
GROUP BY LatDD,LongDD";

/*
* If bbox variable is set, only return records that are within the bounding box
* bbox should be a string in the form of 'southwest_lng,southwest_lat,northeast_lng,northeast_lat'
* Leaflet: map.getBounds().pad(0.05).toBBoxString()
*/
if (isset($_GET['bbox']) || isset($_POST['bbox'])) {
    $bbox = explode(',', $_GET['bbox']);
    $sql = $sql . ' WHERE x <= ' . $bbox[2] . ' AND x >= ' . $bbox[0] . ' AND y <= ' . $bbox[3] . ' AND y >= ' . $bbox[1];
}

# Try query or error
$rs = $conn->query($sql);
if (!$rs) {
    echo 'An SQL error occured.\n';
    exit;
}

# Build GeoJSON feature collection array
$geojson = array(
   'type'      => 'FeatureCollection',
   'features'  => array()
);

# Loop through rows to build feature arrays
while ($row = $rs->fetch(PDO::FETCH_ASSOC)) {
    $properties = $row;
    # Remove x and y fields from properties (optional)
    unset($properties['x']);
    unset($properties['y']);
    $feature = array(
        'type' => 'Feature',
        'geometry' => array(
            'type' => 'Point',
            'coordinates' => array(
                $row['x'],
                $row['y']
            )
        ),
        'properties' => $properties
    );
    # Add feature arrays to feature collection array
    array_push($geojson['features'], $feature);
}

header('Content-type: application/json');
echo json_encode($geojson, JSON_NUMERIC_CHECK);
$conn = NULL;
?>
