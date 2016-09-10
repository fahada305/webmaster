<?php
$user = Yii::$app->user->identity; 


?>
	
                    
                    <li>
						<a href="#"><span><?=Yii::t('app','User Setting') ?></span> <i class="icon-users"></i></a>
						<ul>
							<li><a href="<?= Yii::getAlias('@web'); ?>/admin/user/"><?=Yii::t('app','Manage Users') ?></a></li>
							<li><a href="<?= Yii::getAlias('@web'); ?>/admin/user/add-user"><?=Yii::t('app','Add User') ?></a></li>
                          
                           
						</ul>
					</li>
					
					
					 <li>
						<a href="#"><span><?=Yii::t('app','Manage Language') ?></span> <i class="icon-globe"></i></a>
						<ul>
							<li><a href="<?= Yii::getAlias('@web'); ?>/admin/language/">
								<?=Yii::t('app','Manage Language') ?></a>
							</li>
							<li><a href="<?= Yii::getAlias('@web'); ?>/admin/language/create">
								<?=Yii::t('app','Add Language') ?></a>
							</li>
                           
						</ul>
					</li>


					 <li>
						<a href="#"><span><?=Yii::t('app','Suppliers Address') ?></span> <i class="icon-grid"></i></a>
						<ul>
							<li><a href="<?= Yii::getAlias('@web'); ?>/admin/supplier-address/">
								<?=Yii::t('app','Manage Address') ?></a>
							</li>
							<li><a href="<?= Yii::getAlias('@web'); ?>/admin/supplier-address/create">
								<?=Yii::t('app','Add Address') ?></a>
							</li>
                           
						</ul>
					</li>