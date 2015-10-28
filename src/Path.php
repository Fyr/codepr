<? 
class Path {

	static public function dirContent($path, $searchRE = '') {
		if (substr($path, -1, 1) !== '/') {
			$path.= '/';
		}
		if (!file_exists($path)) {
			throw new Exception('Path `'.$path.'` does not exist!');
		}
		$_ret = array('path' => $path);
		$dirs = array();
		$d = dir($path);
		while (false !== ($entry = $d->read())) {
			if ($entry !== '.' && $entry !== '..' && $entry !== '.svn') {
				if (is_dir($path.$entry)) {
					$_ret['folders'][] = $entry;
				} else {
					if ($searchRE) {
						if (preg_match($searchRE, $entry, $match)) {
							$_ret['files'][] = $entry;
						}
					} else {
						$_ret['files'][] = $entry;
					}
				}
			}
		}
		$d->close();
		return $_ret;
	}
}