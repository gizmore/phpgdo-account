<?php
namespace GDO\Account\lang;

return [
	'module_account' => 'Nutzerkonto',
	'btn_account' => 'Konto',
	'link_account_form' => 'Ihr Konto',
	'link_account_delete' => 'Konto Löschen',
	'link_settings' => 'Einstellungen',
	'prune' => 'Entfernen',
	# #########################################################
	'cfg_adult_age' => 'Erwachsenenalter',
	'tt_cfg_adult_age' => 'Geben Sie das Mindestalter an für Inhalt für Erwachsene.',
	'cfg_account_changetime' => 'Demographie kann nur alle ... geändert werden',
	'cfg_allow_real_name' => 'Erlauben den Realnamen zu ändern?',
	'cfg_allow_guest_settings' => 'Erlaube Gästen das Konto anzupassen',
	'cfg_allow_country_change' => 'Erlaube Nutzern ihr Land zu ändern?',
	'cfg_allow_lang_change' => 'Erlaube Nutzern die Sprache zu ändern?',
	'cfg_allow_birthday_change' => 'Erlaube Nutzern ihr Geburtsdatum zu ändern?',
	'cfg_allow_gender_change' => 'Erlaube Nutzern das Geschlecht zu ändern?',
	'cfg_allow_email_change' => 'Erlaube Nutzern die Email zu ändern?',
	'cfg_feature_account_deletion' => 'Aktiviere Löschen von Konten?',
	'cfg_feature_demographic_mail_confirm' => 'Email Änderungen per Email bestätigen?',
	# #########################################################
	'box_content_account_settings' => 'Hier finden Sie alle Ihre Einstellungen.',
	'mt_account_settings' => '%s Einstellungen',
	'div_user_settings' => 'Persönliche %s-Einstellungen',
	'div_variables' => 'Ihre %s Variablen',
	# #########################################################
	'mt_account_form' => 'Konto',
	'infobox_account_form' => 'Hinweis: Ihren &quot;Realnamen&quot; können Sie nur einmalig setzen und <b>er ist öffentlich sichtbar</b>.<br/>Ihre Demographischen Optionen können sie alle %s ändern.',
	'section_login' => 'Kontoinformationen',
	'section_email' => 'E-Mail Einstellungen',
	'section_demographic' => 'Demographie',
	'section_options' => 'Optionen',
	'user_hide_online' => 'Online status verstecken?',
	'user_want_adult' => 'Inhalt für Erwachsene anzeigen?',
	'user_show_birthdays' => 'Geburtstage anzeigen?',
	'msg_real_name_now' => 'Ihr "Realname" ist nun %s.',
	'msg_user_hide_online_on' => 'Ihr Online Status ist nun unsichtbar.',
	'msg_user_show_birthdays_on' => 'Sie haben nun Geburtstagsmeldungen aktiviert.',
	'msg_user_want_adult_on' => 'Sie sehen nun Inhalte für Erwachsene.',
	'msg_mail_sent' => 'Ihnen wurde eine E-Mail mit Anweisungen zugesandt.',
	'msg_demo_changed' => 'Ihre demographischen Einstellungen wurden geändert.',
	'msg_email_fmt_now_html' => 'Ihr bevorzugtes E-Mail Format ist nun HTML.',
	'msg_email_fmt_now_text' => 'Ihr bevorzugtes E-Mail Format ist nun PLAINTEXT.',
	'err_demo_wait' => 'Bitte warten Sie %s bevor Sie ihre Einstellungen ändern.',
	# #########################################################
	'mt_account_delete' => 'Konto löschen',
	'box_info_deletion' => 'Du kannst dein Konto deaktivieren und deine Identität auf %s bewahren,
oder dein Konto mit allen zugehörigen Informationen vollständig entfernen.
Wenn du möchtest, kannst du uns eine Nachricht hinterlassen, warum du gehen möchtest.',
	'btn_delete_account' => 'Als gelöscht markieren',
	'btn_prune_account' => 'Konto vollständig entfernen',
	'msg_account_marked_deleted' => 'Dein Konto wurde als gelöscht markiert.',
	'msg_account_pruned' => 'Dein Konto wurde aus der Datenbank entfernt.',
	# #########################################################
	'mt_change_mail' => 'E-Mail ändern',
	'err_email_retype' => 'Bitte prüfe deine E-Mail-Adresse erneut; die Wiederholung stimmt nicht überein.',
	'btn_changemail' => 'E-Mail ändern',
	# #########################################################
	'mail_subj_account_deleted' => '[%s] %s Kontolöschung',
	'mail_body_account_deleted' => '
Hallo %s,

Der Benutzer %s hat gerade die folgende Aktion für sein Konto ausgeführt: %s.

Er hat folgende Notiz hinterlassen (kann leer sein):
----------------------------------------------
%s
----------------------------------------------
Viele Grüße
Das %s-System',
	# #########################################################
	'mail_subj_chmail_a' => '[%s] E-Mail ändern',
	'mail_body_chmail_a' => '
Hallo %s,

Sie möchten Ihre E-Mail-Adresse auf %s in <b>%s</b> ändern.

Um diese Änderung zu bestätigen, besuchen Sie bitte den folgenden Link.

%s

Viele Grüße
Das %2$s-Team',
	# #########################################################
	'mail_subj_chmail_b' => '[%s] E-Mail bestätigen',
	'mail_body_chmail_b' => '
Hallo %s,

Sie möchten Ihre E-Mail-Adresse auf %s in %s ändern.

Um diese Änderung zu bestätigen, besuchen Sie bitte den folgenden Link.

%s

Viele Grüße
Das %2$s-Team.',
	# #########################################################
	'mail_subj_demochange' => '[%s] Demografische Änderung',
	'mail_body_demochange' => '
Hallo %s,

Sie möchten Ihre demografischen Einstellungen auf %s ändern.
Bitte prüfen Sie, ob die folgenden Angaben korrekt sind,
weil Sie diese nur einmal alle %s ändern können.

Land: %s
Sprache: %s
Geschlecht: %s

Wenn die Angaben korrekt sind, können Sie sie über diesen Link bestätigen.

%s

Andernfalls ignorieren Sie diese E-Mail bitte und versuchen es später erneut.

Viele Grüße
Das %2$s-Team',
	# #########################################################
	'confirm_account_prune' => 'Möchten Sie Ihr Konto wirklich vollständig entfernen? Dies lässt sich nicht rückgängig machen!',
	'table_account_access' => '%s für Sie protokollierte IP-Adressen',
	'confirm_account_delete' => 'Möchten Sie Ihr Konto wirklich als gelöscht markieren? Dies ist nicht endgültig. Ein Mitarbeiter kann Ihr Konto später wieder reaktivieren.',
	'msg_mail_changed' => 'Ihre Email wurde zu %s geändert.',
	'md_account_access' => 'Sehen Sie sich Ihre letzten Authentifizierungen an.',
	# 6.11.0
	'div_user_textual_settings' => 'Text Einstellungen',

	# 7.0.0
	'mt_account_settings' => 'Einstellungen',
	'mt_account_allsettings' => 'Alle Einstellungen',
	'mt_account_config' => 'Konfiguration',
	'msg_settings_saved' => 'Ihre Einstellungen für das %s Modul wurden übernommen:<br/>%s',

	'btn_save_settings' => '%s-Einstellungen speichern',

	'info_all_settings' => 'Hier kannst du deine Einstellungen für alle Module verwalten. Fast jede Einstellung bietet ACL-Sichtbarkeiten, mit denen du steuerst, was im Profil sichtbar ist.',
];
