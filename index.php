<?php 

# This function reads your DATABASE_URL config var and returns a connection
# string suitable for pg_connect. Put this in your app.
function pg_connection_string_from_database_url() {
    $user = "akbqifdhcjxhgn";
    $pass = "pwVJlSdo8yfBc-u7ON7bf_1Mj0";
    $host = "ec2-54-243-199-79.compute-1.amazonaws.com";
    $db = "d95ic7danf4fsl";
  extract(parse_url("postgres://akbqifdhcjxhgn:pwVJlSdo8yfBc-u7ON7bf_1Mj0@ec2-54-243-199-79.compute-1.amazonaws.com:5432/d95ic7danf4fsl"));
  return "user=$user password=$pass host=$host dbname=" . $db; # <- you may want to add sslmode=require there too
}

$pg_conn = pg_connect(pg_connection_string_from_database_url());




if($_POST){
    
// the message
$msg = json_encode($_POST);
// send email

# Here we establish the connection. Yes, that's all.

# Now let's use the connection for something silly just to prove it works:
//pg_query($pg_conn, "CREATE TABLE postdata( id integer PRIMARY KEY NOT NULL, post_data text NOT NULL);");
pg_query($pg_conn, "INSERT INTO postdata(id, post_data) values (3,'$msg')");

die;


}else{

$result = pg_query($pg_conn, "SELECT * FROM postdata;");
echo 'view data';
print "<pre>\n";
if (!pg_num_rows($result)) {
  print("Your connection is working, but your database is empty.\nFret not. This is expected for new apps.\n");
} else {
  print "Tables in your database:\n";
  while ($row = pg_fetch_row($result)) { print_r($row); }
}
print "\n";


die;
}


?>
