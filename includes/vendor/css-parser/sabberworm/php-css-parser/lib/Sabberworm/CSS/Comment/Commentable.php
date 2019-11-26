<?php

namespace Sabberworm\CSS\Comment;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
interface Commentable {

	/**
	 * @param array $aComments Array of comments.
	 */
	public function addComments(array $aComments);

	/**
	 * @return array
	 */
	public function getComments();

	/**
	 * @param array $aComments Array containing Comment objects.
	 */
	public function setComments(array $aComments);


}
