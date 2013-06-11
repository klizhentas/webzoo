<?php
$data = [
];

$headers = [];
foreach (getallheaders() as $name => $value) {
    $headers[] = [$name, $value];
}
$data["headers"] = $headers;

function convert($vals)
{
    $dict = [];
    foreach ($vals as $name => $value) {
        if(is_array($value)){
            $dict[$name] = $value;
        }
        else{
            $dict[$name] = [$value];
        }
    }
    return $dict;
}

function convert_files($files)
{
    $dict = [];
    foreach ($files as $name => $value) {
        $uploads = [];
        if(is_array($value["name"])){
            // this means multiple files apparently,
            // convert to list of dict
            foreach($value["name"] as $idx => $dumb){
               $uploads[] = [
                   "name" => $value["name"][$idx],
                   "tmp_name" => $value["tmp_name"][$idx]
               ];
            }
        }
        else {
            $uploads = [$value];
        }

        $dict[$name] = [];
        foreach($uploads as $idx => $upload) {
             $dict[$name][] = [
                  "name" => $upload["name"],
                  "data" => base64_encode(file_get_contents($upload["tmp_name"])),
             ];
        }
    }
    return $dict;
}


$data["form"] = convert($_REQUEST);
$data["args"] = convert($_GET);
$data["files"] = convert_files($_FILES);

header('Content-Type: application/json');
echo json_encode($data);
?>
