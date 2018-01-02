<?php

require 'includes/dbconn.php';


$createSequenceQuery = 'CREATE SEQUENCE adobe_api_seq START 1;';

if ( pg_query($createSequenceQuery) ){
	print_r("Sequence created");

	$query = 'CREATE TABLE "public"."adobe_api" (
    "id" bigint DEFAULT 'adobe_api_seq',
    "community_id" bigint,
    "access_token" text,
    "updated_by" bigint,
    "updated_on" timestamp,
    PRIMARY KEY ("id"),
    UNIQUE ("community_id"),
    FOREIGN KEY ("community_id") REFERENCES "public"."community_info"("community_id"),
    FOREIGN KEY ("updated_by") REFERENCES "public"."usr"("id")
);';
	
	if ( pg_query($query) ){
		print_r("Created table");
	}


}

else {
	print_r("Failed to create Sequence");
}

?>