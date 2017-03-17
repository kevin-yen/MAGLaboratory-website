<div class="panel-body">
  <table <?php echo MtHaml\Runtime::renderAttributes(array(array('class', ('table-striped' . ' ' . 'table-hover')), array('style', ('width: 100%;'))), 'html5', 'UTF-8'); ?>>
    <thead>
      <tr>
        <th>Sensor</th>
        <th>Status</th>
        <th></th>
        <th>Last Update</th>
      </tr>
    </thead>
    <tbody>
      <?php echo '<?'; ?>php date_default_timezone_set('America/Los_Angeles'); ?>
      <?php echo '<?'; ?>php foreach($this->data->latestStatus as $sensor => $v){ ?>
      <tr>
        <td><?php echo '<?'; ?>php echo $sensor; ?></td>
        <td><?php echo '<?'; ?>php echo $v[0]; ?></td>
        <td>
          <?php echo '<?'; ?>php if($v[1]){ ?>
          <time <?php echo MtHaml\Runtime::renderAttributes(array(array('class', 'timeago'), array(('datetime'), '<?php echo date(\'c\', $v[1]); ?>')), 'html5', 'UTF-8'); ?>></time>
          <?php echo '<?'; ?>php } ?>
        </td>
        <td><?php echo '<?'; ?>php echo($v[1] ? date('M j, Y g:i A T', $v[1]) : 'NEVER'); ?></td>
      </tr>
      <?php echo '<?'; ?>php } ?>
    </tbody>
  </table>
</div>
