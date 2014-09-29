<?php defined('SYSPATH') or die('No direct script access.');?>
<h1><?php echo $title; ?></h1>
<p><a href="<?php echo URL::base(true, true); ?>teams/insert">New team</a></p>
<table>
    <tr>
        <th>id.</th>
        <th>Name</th>
    </tr>
    <?php foreach($list as $team): ?>
    <tr> 
        <td><?php echo $team['id']; ?></td>
        <td><?php echo $team['name']; ?></td>
        <td><a href="<?php echo URL::base(true,true); ?>teams/insert/<?php echo $team['id']; ?>">edit</a></td>
        <td><a onclick="return confirmIt(this)" href="<?php echo URL::base(true,true); ?>teams/delete/<?php echo $team['id']; ?>">delete</a></td>
    </tr>
    <?php endforeach; ?>
</table>
<script type="text/javascript">
    function confirmIt(del){
        if(confirm('Are you sure you want to delete this team, along with all the players in it?')){
            location.href = del.getAttribute('href');
        }
        return false;
    }
</script>
