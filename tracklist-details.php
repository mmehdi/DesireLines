<?php include('core/init.core.php');?>
<?php include('header.php');?>
<?php

$term_name = $_GET['term_name'];
$term_type = $_GET['term_type'];

if($term_type==='handle'){
    $term_type='@';
    $where = "WHERE author='".$term_name."'";
}
if($term_type==='hashtag'){
    $term_type='#';
    $where = "WHERE text LIKE '%#".$term_name."%'";
}
if($term_type==='search-term'){
    $term_type='$';
    $where = "WHERE text LIKE '%".$term_name."%'";
}

$select = 'SELECT text,created_at,author,original_tweet_id from tweet ';
$limit =' LIMIT 1000';
$query = $select.$where.' ORDER BY created_at DESC'.$limit;

$_SESSION['tweets_query'] = $select.$where;

$db_results = db_fetch($query);

/*for($ri = 0; $ri < pg_num_rows($db_results); $ri++) {
    
    $row = pg_fetch_array($db_results, $ri);
//    echo "time_stamp: ". $row['time_stamp'];
}*/


//http://dtp-24.sncs.abdn.ac.uk/phpPgAdmin/
//$db = pg_connect('host=http://dtp-24.sncs.abdn.ac.uk port=5432 dbname=tweetdesk user=postgres password=5L1ght1y'); 

//$query = "SELECT * FROM track_list"; 

//$result = pg_query($db,$query); 
//if (!$result) { 
  //  echo "Problem with query " . $query . "<br/>"; 
    //echo pg_last_error(); 
    //exit(); 
//} 

        //print_r($result);
        //die();

  //      while($myrow = pg_fetch_assoc($result)) { 
           // print_r($myrow);
           // printf ("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", $myrow['id'], htmlspecialchars($myrow['firstname']), htmlspecialchars($myrow['surname']), htmlspecialchars($myrow['emailaddress']));
    //    } 

       // die();
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><small><?php echo 'Tracking: ';?></small><br/><?php echo $term_type; echo $term_name;?></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">

        <ol class="breadcrumb">
          <li><a href="tracklist.php">Tracklist</a></li>
          <li class="active">Tracking Details</li>
      </ol>
</div>
<!-- /.row -->

<?php 

    //"0":{"id":10,"tweet":"@ChrisMitchell26 Hi there has been some disruption on that route due to an earlier signal fault. Please contact the help point","user":"ScotRail"},
    //"1":{"id":11,"tweet":"@SusanDumbleton HI Falkirk High or Ghmston and where are you travelling to please?","user":"ScotRail"},
    //"2":{"id":12,"tweet":"@FirstScotland I hear you are withdrawing the 43!!! How come u r not fighting ur corner?","user":""kiwi2506""},
    //"3":{"id":13,"tweet":"the winter treatment plan for tonight http://t.co/Gky6BnggDn","user":"trafficscotland"},


/*$rawData = '{
    "0":{"id":10,"tweet":"@ChrisMitchell26 Hi there has been some disruption on that route due to an earlier signal fault. Please contact the help point","user":"ScotRail"},
    "1":{"id":11,"tweet":"@SusanDumbleton HI Falkirk High or Ghmston and where are you travelling to please?","user":"ScotRail"},
    "2":{"id":12,"tweet":"@ScotRail Trains seem to be running again  but there\'s a huge queue elsewhere waiting for a replacement bus","user":"DeanandMay"},
    "3":{"id":13,"tweet":"@FirstScotland I hear you are withdrawing the 43!!! How come u r not fighting ur corner?","user":"kiwi2506"},
    "4":{"id":14,"tweet":"Aberdeenshire: From Aberdeen to Portlethen on the #A90 Southbound there is an overturned vehicle in lane two (Of two) and traffic is slow.","user":"trafficscotland"},
    "5":{"id":15,"tweet":"Does Robocop reboot live up to cult classic? You have 20 seconds to comply http://t.co/kcmFYh5MVi","user":"AberdeenCity"},
    "6":{"id":16,"tweet":"Glasgow South - Dumbreck Road between Urrdale Road and Nithsdale Road (Ward 5): Dates: These works will take place… http://t.co/b3rWzeGdmM","user":"GlasgowRoads"}
}';
*/
//$tempData = json_decode($rawData, true);
?>
<div class="row" id="term-list">
    <div class="col-lg-10">
        <div class="panel panel-info">
            <div class="panel-heading">
                Tweets mentioning: <?php echo $term_name;?>

    <div class="input-group pull-right">
        <button type="button" class="btn btn-success dropdown-toggle header-button"><span class="fa fa-list-alt fa-fw"></span> Export CSV</button>
    </div><!-- /input-group -->

            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-tweets">
                        <thead>
                            <tr>
                                <th>Tweet</th>
                                <th>Date</th>
                                <th>Author</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            for($ri = 0; $ri < pg_num_rows($db_results); $ri++) {
    
                                $row = pg_fetch_array($db_results, $ri);
                                $text = $row['text'];
                                $created_at = $row['created_at'];
                                $author = $row['author'];
                                $tweet_id = $row['original_tweet_id'];
                                $tweet_link = 'http://twitter.com/'.$author.'/status/'.$tweet_id;
                                $author_link = 'http://twitter.com/'.$author;
                                echo '<tr class="gradeA">';
                                echo '<td class="center"><a href="'.$tweet_link.'">'.$text.'</a></td>';
                                echo '<td class="center">'.$created_at.'</td>';
                                echo '<td class="center"><a href="'.$author_link.'">'.$author.'</a></td>';
 //                               echo "<td class=\"center\"><a href=\"#\" class=\"btn btn-danger btn-sm active\" role=\"button\" onClick=\"deleteTerm($id,'$name')\">Delete</a></td>";
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<!-- /.row -->
<div class="row">
    <div class="col-lg-10">
        <div class="panel panel-info">
            <div class="panel-heading">
                Tweets Per Hour

            <div class='pull-right'>
               <div class="form-group-row">
                <div class='datetimepicker-input-group date'>
                    <button type='button'class="btn btn-primary datetimepicker-form-control" onclick="add_chart_data()">Refresh</button>
                </div>
            </div>
        </div>
                <div class='col-sm-4 pull-right'>
                   <div class="form-group-row">
                    <label for="inputType" class="col-sm-4 control-label">To: </label>
                    <div class='datetimepicker-input-group date'>
                        <input type='text' data-date-format="YYYY-MM-DD hh:mm:ss" class="datetimepicker-form-control" name='chart_datetimepicker_to' id='chart_datetimepicker_to'/>
                    </div>
                </div>
            </div>

            <div class='col-sm-4 pull-right'>
               <div class="form-group-row">
                <label for="inputType" class="col-sm-4 control-label">From: </label>
                <div class='datetimepicker-input-group date'>
                    <input type='text' data-date-format="YYYY-MM-DD hh:mm:ss" class="datetimepicker-form-control" name='chart_datetimepicker_from' id='chart_datetimepicker_from' />
                </div>
            </div>
        </div>

    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div id="morris-tmi-chart"></div>
    </div>
    <!-- /.panel-body -->
</div>
<!-- /.panel -->
</div>
</div> <!-- /.row -->


<!-- /.row -->
<div class="row">
    <div class="col-lg-10">
        <div class="panel panel-info">
            <div class="panel-heading">
                Tweets Per Hour


                <div class='col-sm-4 pull-right'>
                   <div class="form-group-row">
                    <label for="inputType" class="col-sm-4 control-label">To: </label>
                    <div class='datetimepicker-input-group date'>
                        <input type='text' data-date-format="YYYY-MM-DD hh:mm:ss" class="datetimepicker-form-control" />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                </div>
            </div>

            <div class='col-sm-4 pull-right'>
               <div class="form-group-row">
                <label for="inputType" class="col-sm-4 control-label">From: </label>
                <div class='datetimepicker-input-group date'>
                    <input type='text' data-date-format="YYYY-MM-DD hh:mm:ss" class="datetimepicker-form-control"/>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
            </div>
        </div>

    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div id="morris-hour-chart"></div>
    </div>
    <!-- /.panel-body -->
</div>
<!-- /.panel -->
</div>
</div> <!-- /.row -->

<!-- /.row -->
<div class="row">
    <div class="col-lg-10">
        <div class="panel panel-info">
            <div class="panel-heading">
                Tweets Per Day

                <div class='col-sm-4 pull-right'>
                   <div class="form-group-row">
                    <label for="inputType" class="col-sm-4 control-label">To: </label>
                    <div class='datetimepicker-input-group date' id='datetimepicker3'>
                        <input type='text' class="datetimepicker-form-control" />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                </div>
            </div>

            <div class='col-sm-4 pull-right'>
               <div class="form-group-row">
                <label for="inputType" class="col-sm-4 control-label">From: </label>
                <div class='datetimepicker-input-group date' id='datetimepicker4'>
                    <input type='text' class="datetimepicker-form-control" />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
            </div>
        </div>

    </div>

    <!-- /.panel-heading -->
    <div class="panel-body">
        <div id="morris-day-chart"></div>
    </div>
    <!-- /.panel-body -->
</div>
<!-- /.panel -->
</div>
</div> <!-- /.row -->

<?php include('footer.php');?>

<script type="text/javascript" src="http-calls/chart-data.js"> </script>

<script type="text/javascript">

//init date pickers
$('#chart_datetimepicker_from').datetimepicker();
$('#chart_datetimepicker_to').datetimepicker();

$("#chart_datetimepicker_from").on("dp.change",function (e) {
  $('#chart_datetimepicker_to').data("DateTimePicker").setMinDate(e.date);
});
$("#chart_datetimepicker_to").on("dp.change",function (e) {
  $('#chart_datetimepicker_from').data("DateTimePicker").setMinDate(e.date);
});

$('#datetimepicker3').datetimepicker();
$('#datetimepicker4').datetimepicker();

/*$(function() {
    $("td[colspan=3]").find("p").hide();
    $("dataTables-tracklist").click(function(event) {
        event.stopPropagation();
        var $target = $(event.target);
        if ( $target.closest("td").attr("colspan") > 1 ) {
            $target.slideUp();
        } else {
            $target.closest("tr").next().find("p").slideToggle();
        }                    
    });
});*/

//data table init
$('#dataTables-tweets').dataTable({
        aaSorting: [[2, 'desc']],
        bPaginate: true,
        bFilter: true,
        bInfo: false,
        bSortable: true,
        bRetrieve: true,
        aoColumnDefs: [
            { "aTargets": [ 0 ], "bSortable": true },
            { "aTargets": [ 1 ], "bSortable": true },
            { "aTargets": [ 2 ], "bSortable": true }
        ]
    }); 
</script>
