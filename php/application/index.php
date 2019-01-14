<?php

/*
https://dzone.com/articles/deploy-a-php-with-couchbase-application-as-docker

docker-compose run -d --service-ports --name couchbase couchbase
docker-compose run -d --service-ports --name php php

http://localhost:8091 should get you to the Couchbase Server dashboard
http://localhost:8080 should get you to your PHP application.
*/

header("Content-Type: application/json");
$cluster = new CouchbaseCluster("couchbase://" . getenv("COUCHBASE_HOST"));
$bucket = $cluster->openBucket(getenv("COUCHBASE_BUCKET_NAME"), getenv("COUCHBASE_BUCKET_PASSWORD"));
try {
    $result = $bucket->get("nraboy");
} catch (CouchbaseException $e) {
    $bucket->insert("nraboy", array(
        "name" => "Nic Raboy",
        "social_media" => array(
            "twitter" => "https://www.twitter.com/nraboy",
            "website" => "https://www.thepolyglotdeveloper.com"
        )
    ));
    $result = $bucket->get("nraboy");
}
echo json_encode($result->value);
?>