<!-- Modal -->
<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Sign in</h4>
      </div>
      <div class="modal-body">
        
        <?php echo $this->Form->create('User', array('role' => 'form', 'autocomplete' => 'off', 'inputDefaults' => array('label' => false, 'div' => false, 'required' => false))); ?>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-12">
                    <?php echo $this->Form->input('email', array('placeHolder'=>'Email', 'type' => 'text', 'class' => 'form-control'))?>
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <div class="row">
                <div class="col-sm-12">
                    <?php echo $this->Form->input('password', array('placeHolder'=>'Password', 'class' => 'form-control'));?>
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <div class="row">
                <div class="col-sm-12">
                    <div class="checkbox">
                        <label><?php echo $this->Form->checkbox('remember_me'); ?> Remember me</label>
                    </div>
                </div>
            </div>
        </div>
        
    	<div class="row">
    	    <div class="col-sm-12">
    	        <p>
    	            If you do not have an account, please create one <?php echo $this->Html->link('here', array('controller' => 'pages', 'action' => 'home'));?>
    	        </p>
    	    </div>
    	</div>
 
      </div>
      <div class="modal-footer">
        <?php echo $this->Form->end(array('label' => 'Login', 'class' => 'btn btn-primary')); ?>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->