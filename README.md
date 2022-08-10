# phpgdo-account

Account Settings Module for
[GDOv7](https://github.com/gizmore/phpgdo).
Print all user Settings in accordeons and allow to change them.
Allow users to delete their account.


### phpgdo-account: Dependencies

This module depends on
[Login](https://github.com/gizmore/phpgdo-login).


### phpgdo-account: Deletion

GDO makes heavy use of foreign keys and cascading.
Also GDO features "mark as deleted" easily.

Users can decide if they want to mark their account as deleted or prune their account completely.

On prune, the user is deleted from the db and cascades kick in.

On delete, associations stay intact.
the User is rendered with less opacity.


### phpgdo-account: Settings

Modules can have configs, userconfigs and usersettings.

This module allows to change usersettings
and set their profile ACL for userconfigs and usersettings.

The difference between a setting and a config is
that configs cannot be changed by the user.


#### phpgdo-account: License

This module is licensed under the
[GDOv7-License](LICENSE).
