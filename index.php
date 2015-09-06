<?php
include 'header.php'
?>
<?php
if(isset($_POST["DamageButton"])){
    $playerID = addslashes($_POST["playerID"]);
    $hpGrab = mysqli_fetch_assoc(mysqli_query($con,"SELECT current_hp FROM players where id = $playerID LIMIT 1"));
    $damageTaken = addslashes($_POST["damageTaken"]);
    $hp = intval($hpGrab['current_hp']) - intval($damageTaken);
    $update = "UPDATE players SET current_hp= $hp where id = $playerID";
    if ($con->query($update) === TRUE) {
        echo "<br/>HP Updated succesfully";
    } else {
        echo "<br/>Error: " . $insert . "<br>" . $con->error;
    }
}
?>
<script> 
var users = new Array(); 
</script>
<h2>Players</h2>
<table id="sortable" class="table table-bordered table-hover table-condensed">
    <?php
    if ($result = mysqli_query($con,"SELECT * FROM players")) {
        /* fetch associative array */
        echo "<tr>";
        echo "<th>Name</th><th>HP</th><th>AC</th><th>Exp</th><th>Strength</th><th>Dexterity</th><th>Constitution</th><th>Intellect</th><th>Wisdom</th><th>Charisma</th>";
        echo "</tr>";

        ?>
        <tbody>
            <?php
        while ($row = mysqli_fetch_assoc($result)) {
            
           echo "<tr>";
           $strInt = intval($row["strength"]); 
           $dexInt = intval($row["dexterity"]);
           $conInt = intval($row["constitution"]);
           $intInt = intval($row["intelect"]);
           $wisInt = intval($row["wisdom"]);
           $chaInt = intval($row["charisma"]);
           $strMod = (($strInt%2)==0) ? (($strInt - 10)/2) : (($strInt - 11)/2);
           $dexMod = (($dexInt%2)==0) ? (($dexInt - 10)/2) : (($dexInt - 11)/2);
           $conMod = (($conInt%2)==0) ? (($conInt - 10)/2) : (($conInt - 11)/2);
           $intMod = (($intInt%2)==0) ? (($intInt - 10)/2) : (($intInt - 11)/2);
           $wisMod = (($wisInt%2)==0) ? (($wisInt - 10)/2) : (($wisInt - 11)/2);
           $chaMod = (($chaInt%2)==0) ? (($chaInt - 10)/2) : (($chaInt - 11)/2);
           echo "\n<script>\n users.push('" . $row["player_name"] . "');\n </script>\n";
           echo "<td>" . $row["player_name"] . "</td><td>" . $row["current_hp"] . "/" . $row["max_hp"] . "</td><td>" . $row["Armor_Class"] . "</td><td>" . $row["experienceGained"] . "</td><td>" . $row["strength"] . "($strMod)</td><td>" . $row["dexterity"] . "($dexMod)</td><td>" . $row["constitution"] . "($conMod)</td><td>" . $row["intelect"] . "($intMod)</td><td>" . $row["wisdom"] . "($wisMod)</td><td>" . $row["charisma"] . "($chaMod)</td>";
           echo "<td><form id='HPform' action='' method='post'> <input type='hidden' name='playerID' value=' " . $row["id"] . "' /> <input type='number' name='damageTaken' placeHolder='damage taken'/> <button name='DamageButton'> Submit </button>  </form></td>";
           echo "</tr>";
       }
               ?>
        </tbody>
            <?php
       /* free result set */
       mysqli_free_result($result);
   }
   /* close connection */
   ?>
</table>
<style>
#diceTable td:hover{
    background-color: lightgray;
}
#userItems{
    border-collapse: collapse;
    border: 1px solid black;
}
#userItems td {
    border: 1px solid black;
    border-color: lightgray;
}
#userItems th {
    border: 1px solid black;
}
</style>
<h2>dice</h2>
<table id='diceTable' class="table table-bordered table-condensed">
    <tr>
        <th>
            D-100
        </th>
        <th>
            D-20
        </th>
        <th>
            D-12
        </th>
        <th>
            D-10
        </th>
        <th>
            D-8
        </th>
        <th>
            D-6
        </th>
        <th>
            D-4
        </th>
    </tr>
    <tr>
        <td id='d100dice'>
            <label id='d100diceLabel'>0</label>
        </td>
        <td id='d20dice'>
            <label id='d20diceLabel'>0</label>
        </td>
        <td id='d12dice'>
            <label id='d12diceLabel'>0</label>
        </td>
        <td id='d10dice'>
            <label id='d10diceLabel'>0</label>
        </td>
        <td id='d8dice'>
            <label id='d8diceLabel'>0</label>
        </td>
        <td id='d6dice'>
            <label id='d6diceLabel'>0</label>
        </td>
        <td id='d4dice'>
            <label id='d4diceLabel'>0</label>
        </td>
    </tr>
</table>
<h4>Item Bag</h4>
<select id="userList" ><option>Select User</option> </select><br>

<table id="userItems" class="" >
</table>

</body>
<script>
$( document ).ready(function() {

var fixHelper = function(e, ui) {
    ui.children().each(function() {
        $(this).width($(this).width());
    });
    return ui;
};

$("#sortable tbody").sortable({
    helper: fixHelper
}).disableSelection();




    function fillUserList(text, selectID){
        var x = document.getElementById(selectID);
        var option = document.createElement("option");
        option.text = text
        x.add(option);
    }
    for(var i =0; i< users.length; i++){
        fillUserList(users[i], "userList");
    }
    $("#userList").change(function(){
        var table = document.getElementById("userItems");
        table.className = "";
        while(table.rows.length > 0) {
          table.deleteRow(0);
      }
      $.post("FillList.php", { userName: $(this).val() },function(data){
        
        var tr = document.createElement('tr');
        var th1 = document.createElement('th');
        var th2 = document.createElement('th');
        th1.appendChild(document.createTextNode("Item Name"));
        th2.appendChild(document.createTextNode("Item Description"));
        tr.appendChild(th1);
        tr.appendChild(th2);
        table.appendChild(tr);
        var results = $.parseJSON(data);
        for(var i=0; i < results.length; i++){
            var tr = document.createElement('tr');
            var td1 = document.createElement('td');
            var td2 = document.createElement('td');
            td1.appendChild(document.createTextNode(results[i].item_name));
            td2.appendChild(document.createTextNode(results[i].description));
            tr.appendChild(td1);
            tr.appendChild(td2);
            table.appendChild(tr);
        }
    });
  });
$("#d100dice").click(function(){
    $("#d100diceLabel").text(Math.floor((Math.random() * 100) + 1));
});
$("#d20dice").click(function(){
    $("#d20diceLabel").text(Math.floor((Math.random() * 20) + 1));
});
$("#d12dice").click(function(){
    $("#d12diceLabel").text(Math.floor((Math.random() * 12) + 1));
});
$("#d10dice").click(function(){
    $("#d10diceLabel").text(Math.floor((Math.random() * 10) + 1));
});
$("#d8dice").click(function(){
    $("#d8diceLabel").text(Math.floor((Math.random() * 8) + 1));
});
$("#d6dice").click(function(){
    $("#d6diceLabel").text(Math.floor((Math.random() * 6) + 1));
});
$("#d4dice").click(function(){
    $("#d4diceLabel").text(Math.floor((Math.random() * 4) + 1));
});
});
</script>
<?php
mysqli_close($con);
?>
</html