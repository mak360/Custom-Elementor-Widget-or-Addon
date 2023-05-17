<?php
namespace ElementorCustom\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly

class Test extends Widget_Base {

    public function get_name() {
        return 'custom-test';
    }

    public function get_title() {
        return __('Test', 'custom_elementor_widget');
    }

    public function get_icon() {
        return 'eicon-kit-details';
    }

    public function get_categories() {
        return ['custom-category'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_title',
            [
                'label' => __('Custom Title', 'custom_elementor_widget'),
            ]
        );
		
        $this->add_control(
            'test_title',
            [
                'label'             => __('Title', 'custom_elementor_widget'),
                'type'              => Controls_Manager::TEXT,
                'label_block'       => true,
                'default'           => '',
            ]
        );
		
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'question', [
                'label'             => __( 'Question', 'custom_elementor_widget' ),
                'type'              => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'answer', [
                'label'             => __( 'Answer', 'custom_elementor_widget' ),
                'type'              => \Elementor\Controls_Manager::WYSIWYG,
                'default'           => '',
            ]
        );
        
        $this->add_control(
            'list',
            [
                'label'             => __( 'Items', 'custom_elementor_widget' ),
                'type'              => \Elementor\Controls_Manager::REPEATER,
                'fields'            => $repeater->get_controls(),
                'default'           => [
                    [
                        'name'         => __( 'Item #1', 'custom_elementor_widget' ),
                    ]
                ],
                'title_field'       => '{{{ name }}}',
            ]
        );

        $this->end_controls_section();
    }
    
    
    protected function render() {
        $settings                           = $this->get_settings();
        $test_title                         = $this->get_settings('test_title');
        $list                               = $this->get_settings('list');
        ?>
       <!-- start repeated content -->
        <h1><?php echo $test_title; ?></h1>
        <?php foreach ($list as $r) { ?>
        <h3><?php echo $r['question']; ?></h3>
        <p><?php echo $r['answer']; ?></p>
        <?php } ?>
        <!-- end repeated content -->

 
  
        <?php
    }

    protected function content_template() {

    }
}