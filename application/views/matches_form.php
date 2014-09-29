<?php defined('SYSPATH') or die('No direct script access.');?>
<h1><?php echo $title; ?></h1>
<?php echo Form::open() ?>
    <table>
        <tr>
            <td><?php echo Form::label('id_team1', 'Team1:') ?></td>
            <td><?php echo Form::select('id_team1', $team_options, $match['id_team1']) ?></td>
        </tr>
        <tr>
            <td><?php echo Form::label('id_team2', 'Team2:') ?></td>
            <td><?php echo Form::select('id_team2', $team_options, $match['id_team2']) ?></td>
        </tr>
        <tr>
            <td><?php echo Form::label('date', 'Date:') ?></td>
            <td><input type="date" name="date" value="<?php echo $match['date']; ?>" /></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo Form::submit(null, 'Submit') ?> &nbsp; <a href="<?php echo URL::base(true, true).'matches'; ?>" />Cancel</td>
        </tr>
    </table>
<?php echo Form::close() ?>
<script type="text/javascript">
    <?php if($error): ?>
        alert('The following error occured:\n\n <?php echo $error; ?>');
    <?php endif; ?>
</script>