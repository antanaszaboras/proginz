<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function printAllNewsletters(){
        $con = Configuration::dbConnect();
        $result = mysqli_query($con, "SELECT "
                                    . " newsletter.id AS id,  "
                                    . " newsletter.date AS date, "
                                    . " newsletter.name AS name, "
                                    . " newsletter.description AS description, "
                                    . " category.name AS category "
                                    . " FROM newsletter "
                                    . " LEFT JOIN category ON category.id=newsletter.category "
                                    . " WHERE newsletter.state = '1' " 
                                    . " AND category.state = '1' "
                ) or die(mysqli_error($con));
        while ($newsletter = $result->fetch_object()) {
            echo '<div class="col-sm-6 col-md-4">' 
                    . '<div class="thumbnail">'
                        . '<img alt="100%x200" data-src="holder.js/100%x200" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTkyIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDE5MiAyMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzEwMCV4MjAwCkNyZWF0ZWQgd2l0aCBIb2xkZXIuanMgMi42LjAuCkxlYXJuIG1vcmUgYXQgaHR0cDovL2hvbGRlcmpzLmNvbQooYykgMjAxMi0yMDE1IEl2YW4gTWFsb3BpbnNreSAtIGh0dHA6Ly9pbXNreS5jbwotLT48ZGVmcz48c3R5bGUgdHlwZT0idGV4dC9jc3MiPjwhW0NEQVRBWyNob2xkZXJfMTViMzAyMDQ4M2UgdGV4dCB7IGZpbGw6I0FBQUFBQTtmb250LXdlaWdodDpib2xkO2ZvbnQtZmFtaWx5OkFyaWFsLCBIZWx2ZXRpY2EsIE9wZW4gU2Fucywgc2Fucy1zZXJpZiwgbW9ub3NwYWNlO2ZvbnQtc2l6ZToxMHB0IH0gXV0+PC9zdHlsZT48L2RlZnM+PGcgaWQ9ImhvbGRlcl8xNWIzMDIwNDgzZSI+PHJlY3Qgd2lkdGg9IjE5MiIgaGVpZ2h0PSIyMDAiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSI3MS41IiB5PSIxMDQuNSI+MTkyeDIwMDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" data-holder-rendered="true" style="height: 200px; width: 100%; display: block;">'
                        . '<div class="caption">'
                            . '<span>' . $newsletter->date . '<br/>' . $newsletter->category . '</span>'
                            . '<h3>' . $newsletter->name . '</h3>'
                            . '<p>' . $newsletter->description . '</p>'
                        . '</div>'
                    . '</div>'
                . '</div>'; 
        }
        Configuration::dbDisconnect($con);
}