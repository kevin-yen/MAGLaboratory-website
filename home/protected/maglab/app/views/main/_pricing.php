<div id="pricing" class="containment">
<div class="container">
<div class="row">
<h1 class="text-center">
<?php if(isset($pricing_title)) { ?>
<?php echo htmlspecialchars($pricing_title,ENT_QUOTES,'UTF-8'); ?>
<?php } else { ?>
Membership Info
<?php } ?>
</h1>
<?php if(!isset($skip_membership_link) || !$skip_membership_link) { ?>
<p class="text-center">
More information available on the
<strong>
<a <?php echo MtHaml\Runtime::renderAttributes(array(array('href', ('/membership'))), 'html5', 'UTF-8'); ?>>Membership page</a>
</strong>
</p>
<?php } ?>
<div class="panel panel-default col-xs-12 col-sm-3">
<div class="panel-heading">
<h1 class="text-center">Guest</h1>
</div>
<div class="panel-body">
Guests are welcome to
<ul>
<li>
visit the space
</li>
<li>
engage, talk, discuss, dance, play and enjoy themselves
</li>
<li>
partake in public festivities and fun
</li>
<li>
attend classes (fee may apply for some classes)
</li>
<li>
teach classes (please talk to an officer to work out details)
</li>
</ul>
Guests are
<strong class="text-danger">not allowed</strong>
to
<ul>
<li>disregard common sense or otherwise do anything illegal</li>
<li>use equipment (unless accompanied by and helping a General Member)</li>
<li>steal anything including but not limited to tools, supplies, equipment, personal belongings, and/or trash</li>
<li>kidnap, impersonate, pester, lick or kick people and/or objects at the space</li>
<li>injure, maim, kill or otherwise endanger harm upon themselves or others while on premises</li>
</ul>
</div>
<div class="panel-footer text-center">
<strong>Free!</strong>
<br>
<form id="donate_now" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="ZDGPLW6W5E9XJ">
<button class="btn btn-success" type="submit">Donate via PayPal</button>
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
<br>
You can also donate cash or tools/equipment in person
</div>
</div>
<div class="panel panel-success col-xs-12 col-sm-4 col-sm-offset-1">
<div class="panel-heading">
<h1 class="text-center">General</h1>
</div>
<div class="panel-body">
General Members have all basic guest privileges and
<ul>
<li>can use the space whenever it is open</li>
<li>bring a guest to help them work on their project</li>
<li>must leave if the space is closing (last keyholder is leaving and locking up)</li>
<li>use our machines and equipment (heavy machinery requires safety test)</li>
<li>throw stuff away and take out the trash</li>
<li>use publicly available materials (please refill or donate for consumables that you use often)</li>
<li>a locker at the space (please bring your own lock)</li>
<li>should clean up their workspace</li>
<li>return equipment/tools/supplies to their designated location before leaving</li>
</ul>
General Members are
<strong class="text-danger">not allowed</strong>
to
<ul>
<li>do the stuff guests are not allowed to do (except explicitly listed above)</li>
<li>ignore safety procedures and guidelines</li>
<li>damage the space's property through overly excessive use or improper misuse</li>
<li>use the space for illegal activities or to create anything illegal</li>
<li>take or use other member's personal supplies and tools without permission</li>
</ul>
</div>
<div class="panel-footer text-center">
<strong>$50/month</strong>
<br>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="QFSJ8MX7C5L8L">
<button class="btn btn-success" type="submit">Subscribe with Paypal</button>
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
<br>
You may also pay with cash in person
</div>
</div>
<div class="panel panel-primary col-xs-12 col-sm-3 col-sm-offset-1">
<div class="panel-heading">
<h1 class="text-center">Keyholder</h1>
</div>
<div class="panel-body">
Keyholders have all General Member privileges and
<ul>
<li>get an rfid key allowing them to come and go whenever</li>
<li>responsibility to lock up if they are the last keyholder to leave</li>
<li>allow general members to use the space while they are there</li>
<li>officer positions if they're interested in helping with MAG Lab business or administration affairs (on a volunteer basis)</li>
</ul>
Keyholders are
<strong class="text-danger">not allowed</strong>
to
<ul>
<li>do the stuff Guests and General Members are not allowed to do (except explicitly listed above)</li>
<li>duplicate the RFID key or share it with others</li>
</ul>
</div>
<div class="panel-footer text-center">
<strong>$100/month</strong>
<br>
<a <?php echo MtHaml\Runtime::renderAttributes(array(array('class', ('btn' . ' ' . 'btn-primary')), array('href', ('mailto:contact@maglaboratory.org'))), 'html5', 'UTF-8'); ?>>Ask an officer</a>
<br>
<br>
We ask that interested keyholders try the space out as a General Member first.
</div>
</div>
</div>
<div class="row">
<?php if(!isset($skip_membership_link) || !$skip_membership_link) { ?>
<p class="text-center">
If you're interested and want more details, please see the
<strong>
<a <?php echo MtHaml\Runtime::renderAttributes(array(array('href', ('/membership'))), 'html5', 'UTF-8'); ?>>Membership page</a>
</strong>
or contact us.
</p>
<?php } ?>
</div>
</div>
</div>
