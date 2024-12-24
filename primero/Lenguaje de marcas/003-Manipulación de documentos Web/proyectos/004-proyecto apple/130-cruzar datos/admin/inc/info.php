<?php
if(isset($_GET['seccion']) && $_GET['seccion'] == 'info') {
?>
    <div class="json-guide-container">
        <h2 class="json-guide-title">Guía de uso - Campos JSON</h2>
        
        <div class="json-guide-section">
            <h3 class="json-guide-heading">Bloque Mosaico</h3>
            <pre class="json-guide-code">
[
    "contenido celda 1",
    "contenido celda 2",
    "contenido celda 3"
]</pre>
        </div>

        <div class="json-guide-section">
            <h3 class="json-guide-heading">Bloque Caja Dos Columnas</h3>
            <pre class="json-guide-code">
{
    "columna1": "Texto para la primera columna",
    "columna2": "Texto para la segunda columna"
}</pre>
        </div>

        <div class="json-guide-section">
            <h3 class="json-guide-heading">Bloque Pasa Fotos</h3>
            <pre class="json-guide-code">
[
    {
        "imagen": "imagen1.jpg",
        "titulo": "Título 1",
        "texto": "Descripción 1"
    },
    {
        "imagen": "imagen2.jpg",
        "titulo": "Título 2",
        "texto": "Descripción 2"
    }
]</pre>
        </div>

              <h3 class="json-guide-heading">Videos YouTube</h3>
      <div class="json-guide-section">
            <pre class="json-guide-code">
{
    "En el apartado texto poner la id del video de youtube": "QVBoAtlPCXk",
    
}</pre>
        </div>

        <h3 class="json-guide-heading">Estilo</h3>
      <div class="json-guide-section">
            <pre class="json-guide-code">
            {     "self": {         
"background":"orange",
"text-align":"center"},
"h3":{"color":"green"},
"h4":{"color":"blue"}
 }</pre>
        </div>


    </div>

    <style>
    .json-guide-container {
        max-width: 800px;
        margin: 20px;
        padding: 20px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .json-guide-title {
        color: #2196f3;
        font-size: 20px;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid #2196f3;
    }

    .json-guide-section {
        margin: 10px 0;
        padding: 10px;
        background: #f8f9fa;
        border-left: 4px solid #2196f3;
        border-radius: 4px;
    }

    .json-guide-heading {
        color: #2196f3;
        font-size: 16px;
        margin: 0 0 10px 0;
        padding: 0;
    }

    .json-guide-code {
        background: #282c34;
        color: #fff;
        padding: 15px;
        margin: 0;
        border-radius: 4px;
        overflow-x: auto;
        white-space: pre-wrap;
        font-family: monospace;
        font-size: 14px;
        line-height: 1.4;
    }
    </style>
<?php
}
?>
