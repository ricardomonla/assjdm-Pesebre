<?php  
    
    $appVERLogs = "
        v3.4: Se agregan los relatos, se renombran audios y se actualizan.
        v3.3: Se actualizan los audios y renombran.
        v3.2: Se actualizan los audios y separana algunas musicas.
        v3.1: Viene de la versión v2.24 del modulo ViaCrusis-Audios.
    ";

    $appVER = explode(":", $appVERLogs)[0];

    $lista = "";

    function cargarMP3s( $path=".", $lstNOM = "" ){
        global $lista;
        $lst = [];

        if ( $lstNOM == "" ) $lstNOM = $path ;

        $dir = opendir($path);
        
        while ( $arch = readdir($dir) ){
            // Salta si es la dirección semantica ..
                if ( $arch == "." ) continue;                      
            // Salta si es la dirección semantica ..
                if ( $arch == ".." ) continue;                     
            // Salta si es un directorio.
                if ( is_dir($path.$arch) ) continue;               
            // Salta si no es archivo mp3.
                if ( !isset(explode(".mp3", $arch)[1]) ) continue; 
            
            $src = $path . "/" . $arch;

            $nom = explode("mp3", $arch)[0];
            
            $nom = explode("$", $nom)[0];
            
            $nom = str_replace("_"," ",$nom);

            $lst[$src] = $nom;
        }
        // Ordeno la lista.
            ksort($lst);
        
        // Armo la <ul>:
            $lista .= "<h2>$lstNOM</h2><ul>";

            foreach ($lst as $pth => $nom) $lista .= "<li pth='$pth'>$nom</li>";

            $lista .= "</ul>";
    }
    
    // Crago las listas. los nombres deben ser asi 101v1$Entrada_triunfante.mp3
        cargarMP3s();
    

// Imprimo el HTML.

echo <<<HTML

<html>
<head>
<title>PesebreVivienteBY-2022</title>
<script type='text/javascript'>

    function init() {
        document.addEventListener('click', function(evt) { if (evt.target.tagName.toLowerCase() == 'li') { play(evt.target); } }, false);
    }

    function skip() {
    }

    function play(elem) {
        var audio = document.getElementById('audio');
        
        // audio.src = elem.getAttribute("dir") + elem.textContent + '.mp3';
        audio.src = elem.getAttribute("pth");
        
        audio.play();
        elem.className = 'playing';
        skip = function() {
                elem.className = '';
                if (elem.nextElementSibling) {
                    play(elem.nextElementSibling);
                    }
            }
        }
</script>
<style type="text/css">
    li:hover {
        text-decoration: underline;
    }

    li.playing {
        font-weight: bold;
    }
    .player {
        font-family:verdana;
        font-size:25px;
        position:fixed; 
        top:0px; 
        width: 100%;
        text-align: center;
        word-wrap: break-word;
        background-color: aquamarine;
    }
    .listas {
        overflow-y: scroll; 
        padding-top: 200px;
        line-height: 1.5;
    }
</style>
</head>
<body onload="init()">

<div id="player" class="player" >

    <h1>PesebreVivienteBY-2022</h1>
    <small style="float: right;padding-right: 30px;">$appVER</small>
    
    <audio id="audio" 
        controls="controls" 
        onerror="alert('Could not play MP3 audio file ' + this.src + '!');" 
        onended="skip()" 
        style="width: 100%;"
        >
        HTML5 MP3 audio required (Chrome, Safari, IE 9?)
    </audio>
</div>

<div id="listas" class="listas" >

    $lista

</div>


</body>
</html>

HTML;

?>


