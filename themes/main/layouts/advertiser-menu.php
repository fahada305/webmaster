 					
 					<li>
						<a href="#"><span><?=Yii::t('app','Customer Menu 1') ?></span> <i class="icon-cog"></i></a>
						<ul>
							<li><a href="#"><?=Yii::t('app','Submenu 1') ?></a></li>
							<li><a href="#"><?=Yii::t('app','Submenu 2') ?></a></li>
                          
                           
						</ul>
					</li>

					 <li>
						<a href="#"><span><?=Yii::t('app','Customer Menu 2') ?></span> <i class="icon-list"></i></a>
						<ul>
							<li><a href="#"><?=Yii::t('app','Submenu 1') ?></a></li>
							<li><a href="#"><?=Yii::t('app','Submenu 2') ?></a></li>
                          
                           
						</ul>
					</li>

					 <li>
						<a href="<?=Yii::getAlias('@web')?>/<?=Yii::$app->user->identity->user_role?>/campaigns/"><span><?=Yii::t('app','Manage Campaigns') ?></span> <i class="icon-grid"></i></a>
					</li>
					