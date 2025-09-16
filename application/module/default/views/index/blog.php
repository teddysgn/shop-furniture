<div id="fh5co-contact">
    <div class="container">
        <div class="text-center">
            <h1>Stay Curious</h1>
            <h4>Discover stories, thinking and expertise from writers on any topics.</h4>
        </div>
        <br>
        <div class="row">
            <?php
            $xhtml = '';
            $data = file_get_contents('https://www.apartmenttherapy.com/main.rss');
            $xml    = NEW SimpleXMLElement($data);


            $i = 1;
            foreach ($xml->channel->item as $item){
                if($i == 101) break;
                $link = $item->link;
                $title = $item->title;
                preg_match_all('#.*src="(.*)">(.*)<end>#imsU', $item->description . '<end>', $matches);



                $image      = $matches[1][0];
                $description = $matches[2][0];
                $date = $item->pubDate;

                $xhtml .= '<div href="'.$link.'" class="col-md-12 animate-box" style="margin-bottom: 20px">
                                    
                                        <div class="col-md-4 animate-box container" style="margin-bottom: 20px">
                                            <img style="width: 100%" src="'.$image.'" alt="">
                                        </div>
                                        <div class="col-md-8 animate-box container">
                                            <h3>'.$title. '</h3>
                                            <small>'.$date.'</small>
                                            <p>'.$description.'</p>
                                        </div>
                                   
                                </div>';
                $i++;
            }
            ?>
            <div class="col-md-12 animate-box">
                <div class="fh5co-contact-info row container">
                    <?php echo $xhtml?>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="map" class="animate-box" data-animate-effect="fadeIn"></div>
