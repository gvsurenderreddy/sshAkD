# SSH authorized_keys Deployment

## Introduction
The target is to build an lightweight webapp to manage ssh-key-authentication over different users and servers.
On one side we have some different kind of unix/linux servers, on the other side we have some ssh-keys, who are owned p.e. by some external technicians, dba's or system admins, and at least we have the system-users within the unix/linux systems.
Workflow should be, that one map a key of a specific real-world user to a useraccount on a specific server.

Servers should be discoverable by ip/hostname. This process also populates a list of the system users.
PubKeys should be added manually to the app (and afterwards to the selected users).

## Pattern
On one side we have an API (RESTful) with php. Later this API should persist the data into a sql-db or somewhat.
On the other side we have a frontend. In one case this frontend should be realized per javascript/html5. 'Cause of the RESTful API other frontends shouldn't be difficult to realize.