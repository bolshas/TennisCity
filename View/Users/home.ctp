
<?php 
$profile = $this->request->data['Profile'];

$complete = true;
foreach ($profile as $value) if ($value == '') $complete = false;


// complete profile form if necessary
if (!$complete) {
    
    echo $this->Html->tag('h4', __('Please tell us more about yourself'), array('class' => 'col-sm-12 text-center'));
    
    echo '<div class="col-sm-offset-2 col-sm-8 form-container">';
    
    echo $this->BSForm->create('Profile', array('controller' => 'profiles', 'action' => 'update'));
    
    if (!$profile['born']) echo $this->BSForm->input('born', array('label' => __('Your birth day'), 'dateFormat' => 'YMD'));
    if (!$profile['started']) echo $this->BSForm->input('started', array('label' => __('When did you start to play'), 'dateFormat' => 'Y'));
    if (!$profile['experience']) echo $this->BSForm->BSradio('experience', __('Who do you consider yourself'), array('amateur' => __('amateur'), 'professional' => __('profesional')));
    if (!$profile['hand']) echo $this->BSForm->BSradio('hand', __('Which is your main hand'), array('right' => 'right', 'left' => 'left'));
    if (!$profile['sex']) echo $this->BSForm->BSradio('sex', __('What is your sex'), array('male' => 'male', 'female' => 'female'));
    if (!$profile['country']) echo $this->BSForm->input('country', __('Where do you come from'));
    if (!$profile['city_id']) echo $this->BSForm->input('City');
    if (!$profile['photo'])  echo $this->BSForm->BSfile('photo');
    
    echo $this->BSForm->end(array('label' => 'Update'));
    
    echo '</div>';
}
