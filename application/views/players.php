<?php defined('SYSPATH') or die('No direct script access.');?>
<h1><?php echo $title; ?></h1>
<p><a href="<?php echo URL::base(true, true); ?>players/insert">New player</a></p>
<table>
    <tr>
        <th>id.</th>
        <th>Name</th>
        <th>Surname</th>
        <th>Team</th>
    </tr>
    <?php foreach($list as $player): ?>
    <tr> 
        <td><?php echo $player['id'] ?></td>
        <td><?php echo $player['name'] ?></td>
        <td><?php echo $player['family'] ?></td>
        <td style="font-size: smaller; font-style: italic"><?php echo $player['team_name'] ?></td>
        <td><a href="<?php echo URL::base(true,true); ?>players/insert/<?php echo $player['id']; ?>">edit</a></td>
        <td><a onclick="return confirmIt(this)" href="<?php echo URL::base(true,true); ?>players/delete/<?php echo $player['id']; ?>">delete</a></td>
    </tr>
    <?php endforeach; ?>
</table>
<script type="text/javascript">
    function confirmIt(del){
        if(confirm('Are you sure you want to delete this player')){
            location.href = del.getAttribute('href');
        }
        return false;
    }
</script>