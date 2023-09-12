<?php
/*
***************************************************************************
*   Copyright (C) 2007 by Cesar D. Rodas                                  *
*   crodas@phpy.org                                                       *
*                                                                         *
*   Permission is hereby granted, free of charge, to any person obtaining *
*   a copy of this software and associated documentation files (the       *
*   "Software"), to deal in the Software without restriction, including   *
*   without limitation the rights to use, copy, modify, merge, publish,   *
*   distribute, sublicense, and/or sell copies of the Software, and to    *
*   permit persons to whom the Software is furnished to do so, subject to *
*   the following conditions:                                             *
*                                                                         *
*   The above copyright notice and this permission notice shall be        *
*   included in all copies or substantial portions of the Software.       *
*                                                                         *
*   THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,       *
*   EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF    *
*   MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.*
*   IN NO EVENT SHALL THE AUTHORS BE LIABLE FOR ANY CLAIM, DAMAGES OR     *
*   OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, *
*   ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR *
*   OTHER DEALINGS IN THE SOFTWARE.                                       *
***************************************************************************
*/

class a {
    var $a;
    var $b;
    var $c;
    
    function a() {
        $this->a = 5 / 3;
        $this->b = true;
        $this->c = range(5,100); 
    }
}

class b {
    var $class_a;
    var $b;
    var $c;
    function b() {
        for($i=0; $i < 50; $i++)
            $this->class_a[] = new a;
        $this->b = "this is a text";    
        $this->c = true;
    }
}

$obj = new b;
require "JSON.php";
$json = new JSON;
$var = $json->serialize( $obj );

?>
<script>
    alert("Testing JSON in a javascript intepreter");
    try {
        obj = eval('(<?=addslashes($var)?>)');
        alert(obj.class_a[0].a);
        alert(obj.b);
    } catch (e) {
        alert("Error:" + e);
    }
</script>
<?php
echo "<h1>The JSON to php</h1>";
print "<pre>".print_r( $json->unserialize( $var ),true)."</pre>";
?>