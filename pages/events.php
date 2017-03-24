<?php include 'google_analytics.php'; ?>

<div class="col-md-11 content-container">
    <div class="content">
        <h1>News &amp; Events</h1>
        <img src="images/events.jpg" alt="News &amp; Events" class="img-responsive img-header"/>
        <p>
            Do you have a birthday, engagement or other special occasion or just want
            to keep updated with what’s going on at Casellas? Come and celebrate it at in style at Casellas.
        </p>
        <p>
            Specialising in all styles of functions from 30 – 250 people in our modern contemporary dining room,
            lounge or private dining room overlooking the beach front. Whether it be corporate, formal or casual,
            sit down or cocktail our professional and friendly functions team will make your event a memorable one!
        </p>
        <p>
            Keep up to date with news and events @ Casellas by signing up to our VIP Loyalty Club, be the first
            to hear about special events, offers and our popular birthday on us program
        </p>
        <h1>Casellas Updates:</h1>
        <div class="basic" id="list1b" style="padding-bottom: 10px;">
            <?php
            $countEvents = "SELECT COUNT(EventDate) FROM Events";
            $eventCountResult = mysql_fetch_array(mysql_query($countEvents));

            if ($eventCountResult[0] == 0) {
                echo "<div><p style='color: yellow; font-style: italic'>***We will keep you posted.</p></div>";
            } else {
                $countEventsInRange = "SELECT COUNT(EventID) FROM Events WHERE Status = '1'
                        AND EventDate BETWEEN now() AND EventDate";

                $eventRangeResult = mysql_fetch_array(mysql_query($countEventsInRange));

                if ($eventRangeResult[0] != "0") {
                    $fetchEvents = "SELECT EventID, EventTitle, EventDesc, DATE_FORMAT(EventDate, '%d-%m-%Y'), EventVenue
                        FROM Events WHERE Status = '1'
                        AND EventDate BETWEEN now() AND EventDate
                        ORDER BY EventDate ASC";
                    $eventResult = mysql_query($fetchEvents);

                    while ($eventFields = mysql_fetch_array($eventResult)) {
                        $eventTitle = $eventFields[1];
                        $eventDetails = $eventFields[2];
                        $eventDate = $eventFields[3];
                        $eventVenue = $eventFields[4];
                        ?>
                        <a href="#"><h3><?php echo "$eventDate: $eventTitle"; ?></h3></a>
                        <div>
                            <p><?php echo $eventDetails; ?></p>
                            <p><?php echo "<u>Venue</u>: $eventVenue"; ?></p>
                        </div>
                        <?php
                    }
                } else {
                    echo "<div><p style='color: yellow; font-style: italic'>***We will keep you posted.</p></div>";
                }
            }
            ?>
        </div>
    </div>
</div>