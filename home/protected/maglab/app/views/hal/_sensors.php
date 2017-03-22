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
    <?php date_default_timezone_set('America/Los_Angeles'); ?>
    <?php foreach($latestStatus as $sensor => $v) { ?>
      <tr>
        <td><?php echo htmlspecialchars($sensor,ENT_QUOTES,'UTF-8'); ?></td>
        <td><?php echo htmlspecialchars($v[0],ENT_QUOTES,'UTF-8'); ?></td>
        <td>
          <?php if($v[1]) { ?>
            <time <?php echo MtHaml\Runtime::renderAttributes(array(array('class', 'timeago'), array(('datetime'), (date('c', $v[1])))), 'html5', 'UTF-8'); ?>></time>
          <?php } ?>
        </td>
        <td><?php echo htmlspecialchars($v[1] ? date('M j, Y g:i A T', $v[1]) : 'NEVER',ENT_QUOTES,'UTF-8'); ?></td>
      </tr>
    <?php } ?>
  </tbody>
</table>
