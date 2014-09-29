<?php defined('SYSPATH') or die('No direct script access.');?>
<h1><?php echo $title; ?></h1>
<?php echo Form::open() ?>
    <table>
        <tr>
            <td><?php echo Form::label('name', 'Name:') ?></td>
            <td><?php echo Form::input('name', $player['name']) ?></td>
        </tr>
        <tr>
            <td><?php echo Form::label('family', 'Surname:') ?></td>
            <td><?php echo Form::input('family', $player['family']) ?></td>
        </tr>
        <tr>
            <td><?php echo Form::label('team', 'Team') ?></td>
            <td><?php echo Form::select('id_team', $teams, $player['id_team']) ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo Form::submit(null, 'Submit') ?> &nbsp; <a href="<?php echo URL::base(true, true).'players'; ?>" />Cancel</td>
        </tr>
    </table>
<?php echo Form::close() ?>
<script type="text/javascript">
    <?php if($errors): ?>
        alert('The following errors occured:\n\n <?php echo $errors; ?>');
    <?php endif; ?>
</script>