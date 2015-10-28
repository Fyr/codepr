<?
/**
 * Run PHPUnit with autoload.php as boostrap file. Example:
 * phpunit --bootstrap autoload.php tests/PathTest
 */

	require_once('./src/Path.php');
	
	$path = (isset($_GET['path']) && $_GET['path']) ? $_GET['path'] : '.';
	$pathInfo = Path::dirContent($path);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Example for Path class</title>
		<style>
img {
	position: relative;
	top: 4px;
}
		</style>
	</head>
	<body>
		Current folder is "<?=$pathInfo['path']?>"
		<table style="border: 1px solid #ddd">
			<tbody>
<?
	if ($path !== '.') {
		$path = explode('/', $path);
		array_pop($path);
		$url = 'example.php?path='.urlencode(implode('/', $path));
		
		$folder = '..';
?>
				<tr>
					<td>
						<a href="<?=$url?>"><img src="./img/open_folder.gif" alt="" /></a>
					</td>
					<td>
						<a href="<?=$url?>"><?=$folder?></a>
					</td>
				</tr>
<?
	}
	if (isset($pathInfo['folders'])) {
		foreach($pathInfo['folders'] as $folder) {
			$url = 'example.php?path='.urlencode($pathInfo['path'].$folder);
?>
				<tr>
					<td>
						<a href="<?=$url?>"><img src="./img/open_folder.gif" alt="" /></a>
					</td>
					<td>
						<a href="<?=$url?>"><?=$folder?></a>
					</td>
				</tr>
<?
		}
	}
?>
<?
	if (isset($pathInfo['files'])) {
		foreach($pathInfo['files'] as $file) {
?>
				<tr>
					<td>
						<img src="./img/edit.gif" alt="" />
					</td>
					<td><?=$file?></td>
				</tr>
<?
		}
	}
?>
			</tbody>
		</table>
	</body>
</html>
