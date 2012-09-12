<?php

/*	EPP Client class for PHP, Copyright 2005 CentralNic Ltd
	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

/**
* Low-level functions useful for both EPP clients and servers
* @package Net_EPP
* @version 0.0.4
* @author Gavin Brown <gavin.brown@nospam.centralnic.com>
* @revision $Id: Protocol.php,v 1.4 2011/06/28 09:48:02 gavin Exp $
*/

require_once('PEAR.php');

/**
* Low-level functions useful for both EPP clients and servers
* @package Net_EPP
*/
class Net_EPP_Protocol {

	/**
	* get an EPP frame from the remote peer
	* @param resource $socket a socket connected to the remote peer
	* @return PEAR_Error|string either an error or a string
	*/
	static function getFrame($socket) {
		$hdr = '';
		while (strlen($hdr) < 4)  {
			if (@feof($socket)) return new PEAR_Error('Connection closed (socket is EOF)');
			if (($hdrstr = @fread($socket,4 - strlen($hdr))) !== false) {
				$hdr .= $hdrstr;

			} else {
				return new PEAR_ERROR('Error reading from socket:'.$php_errormsg);

			}
		}

		$unpacked = unpack('N', $hdr);
		$length = $unpacked[1];
		if ($length < 5) {
			return new PEAR_Error(sprintf('Got a bad frame header length of %d bytes from peer', $length));

		} else {
			$length -= 4; // discard the length of the header itself

			// sometimes the socket can be buffered with a limit below the frame
			// length, so we continually read from the socket until we get the full frame:
			$frame = '';
			while (strlen($frame) < $length) $frame .= fread($socket, $length);

			if (strlen($frame) > $length) {
				return new PEAR_Error(sprintf("Frame length (%d bytes) doesn't match header (%d bytes)", strlen($frame), ($length)));

			} else {
				return $frame;

			}
		}
	}

	/**
	* send an EPP frame to the remote peer
	* @param resource $socket a socket connected to the remote peer
	* @param string $xml the XML to send
	*/
	static function sendFrame($socket, $xml) {
		fwrite($socket, pack('N', (strlen($xml)+4)).$xml);
	}
}
