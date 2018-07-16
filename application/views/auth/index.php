<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Users</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Data User
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div id="infoMessage"><?php echo $message;?></div>

							<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
								<thead>
								<tr>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Email</th>
									<th>Groups</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
								</thead>
								<?php foreach ($users as $user):?>
									<tbody>
									<tr>
										<td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
										<td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
										<td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
										<td>
											<?php foreach ($user->groups as $group):?>
												<?php echo anchor("auth/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?><br />
											<?php endforeach?>
										</td>
										<td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, lang('index_active_link')) : anchor("auth/activate/". $user->id, lang('index_inactive_link'));?></td>
										<td><?php echo anchor("auth/edit_user/".$user->id, 'Edit') ;?></td>
									</tr>
									</tbody>
								<?php endforeach;?>
							</table>

							<p><?php echo anchor('auth/create_user', lang('index_create_user_link'))?> | <?php echo anchor('auth/create_group', lang('index_create_group_link'))?></p>
							</div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
</div>