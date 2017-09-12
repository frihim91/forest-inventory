<?php
/*
 * Title:   MySQL Points to GeoJSON
 * Notes:   Query a MySQL table or view of points with x and y columns and return the results in GeoJSON format, suitable for use in OpenLayers, Leaflet, etc.
 * Author:  Bryan R. McBride, GISP
 * Contact: bryanmcbride.com
 * GitHub:  https://github.com/bmcbride/PHP-Database-GeoJSON
 */

# Connect to MySQL database
$conn = new PDO('mysql:host=192.168.0.201;dbname=faobd_db','maruf','maruf');

# Build SQL SELECT statement including x and y columns
$sql = "SELECT k.*,fb.FAOBiomes FROM (select a.FAO_Biome,a.species,a.ID_AE AS ID_AE,a.Latitude AS y,a.Longitude AS x,a.output,
(select count(ae.Species) from ae where ((ae.Latitude = a.Latitude) and (ae.Longitude = a.Longitude)))
AS total_species,(select group_concat(distinct concat(s.Species),' (',(select count(m.Species) from ae m
where ((m.Species = b.Species) and (a.Latitude = m.Latitude) and (a.Longitude = m.Longitude))),') ' separator ', ') AS m
from (ae b left join species s on((b.Species = s.ID_Species))) where ((b.Latitude = a.Latitude)
and (b.Longitude = a.Longitude))) AS species_desc from ae a where (a.Latitude > 0) group by a.Latitude,a.Longitude) k
LEFT JOIN faobiomes fb ON k.FAO_Biome=fb.ID_FAOBiomes";

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
