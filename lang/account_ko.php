<?php
namespace GDO\Account\lang;

return [
	'module_account' => '계정',
	'btn_account' => '계정',
	'link_account_form' => '계정',
	'link_account_delete' => '삭제',
	'link_settings' => '설정',
	'link_account_edit_user' => '모든 설정 편집',
	'prune' => '가지치기',
	'cfg_adult_age' => '성인 연령',
	'tt_cfg_adult_age' => '성인용 콘텐츠의 최소 연령을 지정하세요.',
	'cfg_account_changetime' => '인구통계학적 변경 시간 초과',
	'cfg_allow_real_name' => '실명 변경 허용',
	'cfg_allow_guest_settings' => '손님이 계정을 변경하도록 허용',
	'cfg_allow_country_change' => '국가 변경 허용',
	'cfg_allow_lang_change' => '언어 변경 허용',
	'cfg_allow_birthday_change' => '생년월일 변경 허용',
	'cfg_allow_gender_change' => '성별 변경 허용',
	'cfg_allow_email_change' => '이메일 변경 허용',
	'cfg_feature_account_deletion' => '계정 삭제 허용',
	'cfg_feature_demographic_mail_confirm' => '이메일 확인 활성화',
	'box_content_account_settings' => '여기서는 구성 변수가 있는 활성화된 모든 모듈에 대한 설정을 찾을 수 있습니다.<br/>단지 정보를 제공하는 변수와 전환할 수 있는 설정을 구분합니다.',
	'mt_account_settings' => '%s 설정',
	'mt_account_edit_user' => '%s에 대한 설정 편집',
	'info_account_edit_user' => '%s에 대해 사용 가능한 모든 설정을 편집합니다.',
	'div_user_settings' => '개인 %s 설정',
	'div_variables' => '귀하의 %s 변수',
	'msg_settings_saved' => '%s 모듈에 대한 설정이 저장되었습니다.<br/>%s',
	'mt_account_form' => '계정',
	'infobox_account_form' => '"실명"은 설정된 후에는 변경할 수 없으며 <b>누구에게나 공개됩니다!</b><br/>인구통계학적 옵션은 %s마다 한 번씩 설정할 수 있습니다.',
	'section_login' => '로그인 설정',
	'section_email' => '이메일 설정',
	'section_demographic' => '인구통계',
	'section_options' => '옵션',
	'user_hide_online' => '온라인 상태 숨기기',
	'user_want_adult' => '성인용 콘텐츠 표시',
	'user_show_birthdays' => '나와 다른 사람의 생일 표시',
	'msg_real_name_now' => '귀하의 실제 이름은 이제 %s(으)로 설정되었습니다.',
	'msg_user_hide_online_on' => '이제 귀하의 온라인 상태가 숨겨졌습니다.',
	'msg_user_show_birthdays_on' => '생일 알림을 활성화했으며 자신의 생일이 다른 사람에게 표시됩니다.',
	'msg_user_want_adult_on' => '이제 귀하의 계정에 성인용 콘텐츠가 활성화되었습니다.',
	'msg_mail_sent' => '진행 방법에 대한 지침이 포함된 이메일을 보내드렸습니다.',
	'msg_demo_changed' => '인구통계학적 설정이 변경되었습니다.',
	'msg_email_fmt_now_html' => '이제 선호하는 이메일 형식이 HTML로 설정되었습니다.',
	'msg_email_fmt_now_text' => '선호하는 이메일 형식은 이제 PLAINTEXT로 설정됩니다.',
	'err_demo_wait' => '인구통계 옵션을 다시 변경하려면 %s을(를) 기다려야 합니다.',
	'mt_account_delete' => '계정 삭제',
	'box_info_deletion' => '계정을 비활성화하거나 %s에서 신원을 보존하는 것 중에서 선택할 수 있습니다.
또는 귀하의 계정과 관련된 모든 정보를 완전히 정리하십시오.
원한다면 떠나고 싶은 이유에 대한 피드백이 담긴 메시지를 남길 수 있습니다.',
	'btn_delete_account' => '삭제된 것으로 표시',
	'btn_prune_account' => '계정 정리',
	'msg_account_marked_deleted' => '귀하의 계정은 삭제된 것으로 표시되었습니다.',
	'msg_account_pruned' => '귀하의 계정이 데이터베이스에서 삭제되었습니다.',
	'mt_change_mail' => '이메일 변경',
	'err_email_retype' => '이메일을 올바르게 다시 입력하지 않았으므로 다시 확인하시기 바랍니다.',
	'btn_changemail' => '이메일 변경',
	'mail_subj_account_deleted' => '[%s] %s 계정 삭제',
	'mail_body_account_deleted' => '안녕하세요 %s님,
	
사용자 %s이(가) 자신의 계정에서 다음 작업을 실행했습니다: %s.
	
그는 다음 메모를 남겼습니다: (비어 있을 수 있음)
---------------------------------
%s
---------------------------------
친절한 감사
%s 스크립트',
	'mail_subj_chmail_a' => '[%s] 이메일 변경',
	'mail_body_chmail_a' => '안녕하세요 %s님,
	
%s의 이메일을 새 주소(<b>%s</b>)로 변경하고 싶습니다.
	
이 변경 사항을 수락하려면 다음 링크를 방문하세요.
	
%s
	
친절한 감사
%2$s 팀',
	'mail_subj_chmail_b' => '[%s] 이메일 확인',
	'mail_body_chmail_b' => '안녕하세요 %s님,
	
%s의 이메일을 이 이메일(%s)로 변경하고 싶습니다.
	
변경 사항을 수락하려면 다음 링크를 방문하세요.
	
%s
	
감사합니다,
%2$s 팀.',
	'mail_subj_demochange' => '[%s] 인구통계 변경',
	'mail_body_demochange' => '안녕하세요 %s님,
	
%s의 인구통계학적 설정을 변경하고 싶습니다.
다음 설정이 올바른지 확인하십시오.
%s마다 한 번만 변경할 수 있기 때문입니다.
	
국가: %s
언어: %s
성별: %s
	
정보가 정확하다면 이 링크를 방문하여 이러한 설정을 수락할 수 있습니다.
	
%s
	
그렇지 않은 경우에는 이 이메일을 무시하고 언제든지 다시 시도하십시오.
	
친절한 감사
%2$s 팀',
	'table_account_access' => '%s개의 IP가 기록되었습니다.',
	'confirm_account_prune' => '정말로 데이터베이스에서 귀하의 계정과 그와 관련된 모든 정보를 삭제하시겠습니까? 이 작업은 취소할 수 없습니다!',
	'confirm_account_delete' => '정말로 귀하의 계정을 삭제된 것으로 표시하시겠습니까? 이것은 최종적이지 않습니다. 관리자가 나중에 귀하의 계정을 복구할 수 있습니다.',
	'msg_mail_changed' => '귀하의 이메일이 %s(으)로 변경되었습니다.',
	'md_account_access' => '귀하의 계정에 대한 로그인을 검토하십시오.',
	'div_user_textual_settings' => '텍스트 설정',
	'mt_account_allsettings' => '모든 설정',
	'mt_account_config' => '구성',
	'btn_save_settings' => '%s 설정 저장',
	'info_all_settings' => '여기에서 모든 모듈에 대한 설정을 제어할 수 있습니다. 거의 모든 설정에는 프로필에 표시할 내용을 제어하는 ​​ACL 가시성 옵션이 있습니다.',
];
