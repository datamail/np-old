<ul id="nav">
    <li class="about"><a class="has_children" href="<?php echo $base_url; ?>user/about" >About</a>
        <ul>
            <li><a href="<?php echo $base_url; ?>user/about#why" ?>Why?</a></li>
            <li><a href="<?php echo $base_url; ?>user/contact" ?>Contact</a></li>
        </ul>
    </li>
    <li><a href="<?php echo $base_url; ?>user/inspiration" >Inspiration</a>
    <li class="coding"><a class="has_children coding" href="<?php echo $base_url; ?>user/coding" >Coding</a>
        <ul>
            <li><a href="<?php echo $base_url; ?>user/coding_intro" >Intro</a></li>
            <li><a href="<?php echo $base_url; ?>user/coding_things_to_know" >Coding Basics</a></li>
            <li><a href="<?php echo $base_url; ?>user/coding_important_snippets" >Important Snippets</a></li>
            <li><a href="<?php echo $base_url; ?>user/coding_fonts" >Fonts</a></li>
            <li><a href="<?php echo $base_url; ?>user/coding_examples" >Examples</a></li>
        </ul>
    </li>
    <li><a class="has_children" href="<?php echo $base_url; ?>user/faq" >FAQ / How To</a>
        <ul>
            <li><a href="http://forum.numberpicture.com" target="_blank" >Forum</a></li>
        </ul>
    </li>
    <div class="clear"></div>
</ul>
 
<div class="clear"></div>

<script type='text/javascript'>
    $(document).ready(function () { 
     
    $('#nav li').hover(
        function () {
            //show its submenu
            $('ul', this).slideDown(100);
 
        }, 
        function () {
            //hide its submenu
            $('ul', this).slideUp(100);         
        }
    );   
});
</script>

<div id="learn">
    
