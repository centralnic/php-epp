# README

EPP is the Extensible Provisioning Protocol. EPP (defined in RFC 5730 
and subsequent documents) is an application layer client-server protocol 
for the provisioning and management of objects stored in a shared 
central repository. Specified in XML, the protocol defines generic 
object management operations and an extensible framework that maps 
protocol operations to objects. As of writing, its only well-developed 
application is the provisioning of Internet domain names, hosts, and 
related contact details.

RFC 3734 defines a TCP based transport model for EPP, and the 
Net_EPP_Client class included in this distribution implements a client 
for that model. You can establish and manage EPP connections and send 
and receive responses over these connections.

Net_EPP also provides a high-level EPP frame builder (Net_EPP_Frame) 
which can be used to construct frames that comply with the EPP 
specification and can be used to interact with a server.

The class is organized on similar lines to the Net::EPP::Client Perl 
module.

This program is free software; you can redistribute it and/or modify it 
under the terms of the GNU General Public License as published by the 
Free Software Foundation; either version 2 of the License, or (at your 
option) any later version.

Example use case in code:

```
//load the autoloader class
require_once("php-epp/Net/EPP.php");

if(Net_EPP::autoload('Client')){
    print "autoloading succeeded\n";
}

$epp=new Net_EPP_Client();

$greeting=$epp->connect('servername','port',20);

```