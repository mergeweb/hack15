<?php
namespace App\Filter;
use MiniAsset\Filter\AssetFilter;

class CompassFilter extends AssetFilter
{

	public $settings = array(
		'pre_process_dir' => '/config/compass/sass/',
		'post_process_dir' => '/config/compass/sass/stylesheets/',
	);


	public function input($filename, $contents){
		$filename = basename($filename);
		$tmp_file = ROOT.$this->settings['pre_process_dir'].$filename;
		file_put_contents($tmp_file, $contents);
		$file_parts = explode('.', $filename);
		$compiled_file = ROOT.$this->settings['post_process_dir'].$file_parts[0].'.css';
		
		\SassCompiler::run(ROOT.$this->settings['pre_process_dir'], ROOT.$this->settings['post_process_dir']);

		if(file_exists($compiled_file)){
			$contents = file_get_contents($compiled_file);
			//unlink($compiled_file);
		}
		return $contents;
	}

    public function output($filename, $contents) {
		$filename = basename($filename);
		$tmp_file = ROOT.$this->settings['pre_process_dir'].$filename;
		file_put_contents($tmp_file, $contents);
		$file_parts = explode('.', $filename);
		$compiled_file = ROOT.$this->settings['post_process_dir'].$file_parts[0].'.css';

		\SassCompiler::run(ROOT.$this->settings['pre_process_dir'], ROOT.$this->settings['post_process_dir']);

		if(file_exists($compiled_file)){
			$contents = file_get_contents($compiled_file);
			//unlink($compiled_file);
		}
		return $contents;
    }
}

?>
