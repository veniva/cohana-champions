<?php defined('SYSPATH') or die('No direct script access.');?>
<h1><?php echo $title; ?></h1>
<p><a href="<?php echo URL::base(true, true); ?>matches/insert">New match</a></p>
<table>
    <tr>
        <th>Team 1</th>
        <th>Team 2</th>
        <th>Date</th>
    </tr>
    <?php foreach($list as $match): ?>
    <tr> 
        <td><?php echo $match['team1']; ?></td>
        <td><?php echo $match['team2']; ?></td>
        <td><?php echo date('d-m-Y', strtotime($match['date'])); ?></td>
        <td><a href="<?php echo URL::base(true,true); ?>matches/insert/<?php echo $match['id']; ?>">edit</a></td>
        <td><a onclick="return confirmIt(this)" href="<?php echo URL::base(true,true); ?>matches/delete/<?php echo $match['id']; ?>">delete</a></td>
    </tr>
    <?php endforeach; ?>
</table>
<script type="text/javascript">
    function confirmIt(del){
        if(confirm('Are you sure you want to delete this match?')){
            location.href = del.getAttribute('href');
        }
        return false;
    }
</script>
