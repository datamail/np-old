<?php
$next_and_previous_buttons = '<a class="next_button" href="' . $base_url . 'picture/next_picture/' . $picture_id . '" ><</a>
<a class="previous_button" href="' . $base_url . 'picture/previous_picture/' . $picture_id . '" >></a>';
if($is_data == 1)
{
    if (@GETIMAGESIZE('picture_images/' . $data[0]->image_path)) {
        if($data[0]->is_private == 1 && $data[0]->user_id == $this->session->userdata('user_id'))
        {
            echo("<h1>" . $data[0]->title . "</h1>");
            echo("<div id='learn'><p>" . $data[0]->description . "</p></div>");
            echo($next_and_previous_buttons);
            echo("<img src='" . $base_url  . 'picture_images/' .  $data[0]->image_path . "' />");    
            ?>
            <a href="<?php echo $base_url . 'picture/new_picture/' . $data[0]->template_id ?>" class="psuedo_button">Make A Picture With The Same Template</a>
            <div id="disqus_thread" style="border-top:1px #bbb solid; margin-top: 40px;"></div>
            <?php
            
        }
        elseif($data[0]->is_private != 1)
        {
            echo("<h1>" . $data[0]->title . "</h1>");
            echo("<div id='learn'><p>" . $data[0]->description . "</p></div>");
            echo($next_and_previous_buttons);
            echo("<img src='" . $base_url  . 'picture_images/' .  $data[0]->image_path . "' />");    
            ?>
            <a href="<?php echo $base_url . 'picture/new_picture/' . $data[0]->template_id ?>" class="psuedo_button">Make A Picture With The Same Template</a>
            <div id="disqus_thread" style="border-top:1px #bbb solid; margin-top: 40px;"></div>
            <?php
            
        }
        else {
            echo($next_and_previous_buttons);
            echo "<h1>Private Picture</h1>Sorry, this picture is PRIVATE.<div class='space'></div>";
        }
    }
    else
    {
        echo($next_and_previous_buttons);
        echo "<h1>Not Found</h1>Sorry, this picture cannot be FOUND.<div class='space'></div>";
    }

}
else
{
    echo($next_and_previous_buttons);
    echo "<h1>Not Found</h1>Sorry, this picture cannot be FOUND.<div class='space'></div>";
}
?>
<script type="text/javascript">
                /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
                var disqus_shortname = 'numberpicture'; // required: replace example with your forum shortname
            
                // The following are highly recommended additional parameters. Remove the slashes in front to use.
                // var disqus_identifier = 'unique_dynamic_id_1234';
                // var disqus_url = 'http://example.com/permalink-to-page.html';
            
                /* * * DON'T EDIT BELOW THIS LINE * * */
                (function() {
                    var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                    dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
                    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                })();
            </script>