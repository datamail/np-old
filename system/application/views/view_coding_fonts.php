<style type="text/css">
.font{
    font-size: 1.5em;
    text-align: justify;
    border-bottom: 1px solid #000;
}

.font h2{
    font-size: 1em;
    font-family: inherit;
}

    #lobster {
        font-family: 'Lobster';
    }
    #geo {
        font-family: 'Geo';
    }
    #orbitron {
        font-family: 'Orbitron';
    }
    #sixcaps {
        font-family: 'Swanky and Moo Moo';
    }
    #oswald {
        font-family: 'Oswald';
    }
    #novacut {
        font-family: 'Buda';
    }
    #philosopher {
        font-family: 'Philosopher';
    }
    #allertastencil {
        font-family: 'Monofett';
    }
    #arvo {
        font-family: 'Arvo';
    }
    #railway {
        font-family: 'Railway';
    }
    #dancingscript {
        font-family: 'Ultra';
    }
    #Wireone {
        font-family: 'Wire One';
        font-size: 1.7em;
    }
</style>
<h1>Fonts</h1>
<p>All normal Web-safe fonts including the following list are available for use when creating templates:</p>
<div id="lobster" class="font"><p>
    <h2>Lobster</h2>
The quick brown fox jumps over the lazy dog
</p></div>
<div id="geo" class="font"><p>
    <h2>Geo</h2>
The quick brown fox jumps over the lazy dog
</p></div>
<div id="orbitron" class="font"><p>
    <h2>Orbitron</h2>
The quick brown fox jumps over the lazy dog
</p></div>
<div id="sixcaps" class="font"><p>
    <h2>Swanky and Moo Moo</h2>
The quick brown fox jumps over the lazy dog
</p></div>
<div id="oswald" class="font"><p>
    <h2>Oswald</h2>
The quick brown fox jumps over the lazy dog
</p></div>
<div id="novacut" class="font"><p>
    <h2>Buda</h2>
The quick brown fox jumps over the lazy dog
</p></div>
<div id="philosopher" class="font"><p>
    <h2>Philosopher</h2>
The quick brown fox jumps over the lazy dog
</p></div>
<div id="allertastencil" class="font"><p>
    <h2>Monofett</h2>
The quick brown fox jumps over the lazy dog
</p></div>
<div id="Wireone" class="font"><p>
    <h2>Wire One</h2>
The quick brown fox jumps over the lazy dog
</p></div>
<div id="arvo" class="font"><p>
    <h2>Arvo</h2>
The quick brown fox jumps over the lazy dog
</p></div>
<div id="railway" class="font"><p>
    <h2>Railway</h2>
The quick brown fox jumps over the lazy dog
</p></div>
<div id="dancingscript" class="font"><p>
    <h2>Ultra</h2>
The quick brown fox jumps over the lazy dog
</p></div>

<h2>Using A Font</h2>
<p>To use a font you must load it using the following lines of code:</p>
<pre><code>PFont myFont = loadFont("name_of_font");</code></pre>
<p>And then activate it by using the following line of code:</p>
<pre><code>textFont(myFont, size_of_font);</code></pre>
<p>Example:</p>
<pre><code>PFont myFont = loadFont("Lobster");
textFont(myFont, 20);</code></pre>