

INSERT INTO public.virtual_table(id, virtual_table_name, description, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
  VALUES(1, 'peopleType', 'Usuário administrativo', 'userAdmin', true, true, false, false, '2010-11-16 00:37:35.767738', '2010-11-16 00:37:35.767738');
INSERT INTO public.virtual_table(id, virtual_table_name, description, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
  VALUES(2, 'peopleType', 'Usuário do site', 'userSite', true, true, false, false, '2010-11-16 00:37:35.767738', '2010-11-16 00:37:35.767738');
INSERT INTO public.virtual_table(id, virtual_table_name, description, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
  VALUES(3, 'peopleType', 'Membro de ranking', 'rankingMember', true, true, false, false, '2010-11-16 00:37:35.767738', '2010-11-16 00:37:35.767738');
INSERT INTO public.virtual_table(id, virtual_table_name, description, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
  VALUES(4, 'gameType', 'Texas Hold''em', 'holdem', true, true, false, false, '2010-11-16 00:37:35.767738', '2010-11-16 00:37:35.767738');
INSERT INTO public.virtual_table(id, virtual_table_name, description, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
  VALUES(5, 'gameType', 'Stud', 'stud', true, true, false, false, '2010-11-16 00:37:35.767738', '2010-11-16 00:37:35.767738');
INSERT INTO public.virtual_table(id, virtual_table_name, description, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
  VALUES(6, 'gameType', 'Omaha', 'omaha', true, true, false, false, '2010-11-16 00:37:35.767738', '2010-11-16 00:37:35.767738');
INSERT INTO public.virtual_table(id, virtual_table_name, description, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
  VALUES(7, 'gameType', 'Todos', 'mixed', true, true, false, false, '2010-11-16 00:37:35.767738', '2010-11-16 00:37:35.767738');
INSERT INTO public.virtual_table(id, virtual_table_name, description, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
  VALUES(8, 'gameStyle', 'Torneio', 'tournament', true, true, false, false, '2010-11-16 00:37:35.767738', '2010-11-16 00:37:35.767738');
INSERT INTO public.virtual_table(id, virtual_table_name, description, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
  VALUES(9, 'gameStyle', 'Ring game', 'ring', true, true, false, false, '2010-11-16 00:37:35.767738', '2010-11-16 00:37:35.767738');
INSERT INTO public.virtual_table(id, virtual_table_name, description, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
  VALUES(10, 'gameStyle', 'Sit & Go', 'sitngo', true, true, false, false, '2010-11-16 00:37:35.767738', '2010-11-16 00:37:35.767738');
INSERT INTO public.virtual_table(id, virtual_table_name, description, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
  VALUES(11, 'rankingType', 'Ganhos', 'value', true, true, false, false, '2010-11-16 00:37:35.767738', '2010-11-16 00:37:35.767738');
INSERT INTO public.virtual_table(id, virtual_table_name, description, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
  VALUES(12, 'rankingType', 'Classificação', 'position', true, true, false, false, '2010-11-16 00:37:35.767738', '2010-11-16 00:37:35.767738');
INSERT INTO public.virtual_table(id, virtual_table_name, description, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
  VALUES(13, 'rankingType', 'Balanço', 'balance', true, true, false, false, '2010-11-17 00:23:42.35283', '2010-11-17 00:23:42.35283');


INSERT INTO public.people(id, people_type_id, first_name, last_name, full_name, email_address, birthday, enabled, visible, locked, deleted, created_at, updated_at)
  VALUES(1, 2, 'Luciano', 'Stegun', 'Luciano Stegun', 'lucianostegun@gmail.com', NULL, true, true, false, false, '2010-11-16 00:38:31.0', '2010-11-16 00:38:31.0');
INSERT INTO public.people(id, people_type_id, first_name, last_name, full_name, email_address, birthday, enabled, visible, locked, deleted, created_at, updated_at)
  VALUES(8, 3, 'Alan', '', 'Alan', 'alan@gmail.com', NULL, true, true, false, false, '2010-11-16 12:42:23.0', '2010-11-16 12:42:23.0');
INSERT INTO public.people(id, people_type_id, first_name, last_name, full_name, email_address, birthday, enabled, visible, locked, deleted, created_at, updated_at)
  VALUES(2, 3, 'Wagner', 'André', 'Wagner André', 'omegalinux@gmail.com', NULL, true, true, false, false, '2010-11-16 00:40:22.0', '2010-11-16 00:40:22.0');
INSERT INTO public.people(id, people_type_id, first_name, last_name, full_name, email_address, birthday, enabled, visible, locked, deleted, created_at, updated_at)
  VALUES(3, 3, 'Diogo', 'Nunes', 'Diogo Nunes', 'diogownunes@gmail.com', NULL, true, true, false, false, '2010-11-16 00:40:32.0', '2010-11-16 00:40:32.0');
INSERT INTO public.people(id, people_type_id, first_name, last_name, full_name, email_address, birthday, enabled, visible, locked, deleted, created_at, updated_at)
  VALUES(9, 3, 'Daniel', '', 'Daniel', 'daniel@gmail.com', NULL, true, true, false, false, '2010-11-16 12:42:34.0', '2010-11-16 12:42:34.0');
INSERT INTO public.people(id, people_type_id, first_name, last_name, full_name, email_address, birthday, enabled, visible, locked, deleted, created_at, updated_at)
  VALUES(4, 3, 'Reynaldo', 'Rancan', 'Reynaldo Rancan', 'rrancan@gmail.com', NULL, true, true, false, false, '2010-11-16 00:40:44.0', '2010-11-16 00:40:44.0');
INSERT INTO public.people(id, people_type_id, first_name, last_name, full_name, email_address, birthday, enabled, visible, locked, deleted, created_at, updated_at)
  VALUES(5, 3, 'Kaue', 'Carbonari', 'Kaue Carbonari', 'kaue.q.carbonari@accenture.com', NULL, true, true, false, false, '2010-11-16 00:40:57.0', '2010-11-16 00:40:57.0');
INSERT INTO public.people(id, people_type_id, first_name, last_name, full_name, email_address, birthday, enabled, visible, locked, deleted, created_at, updated_at)
  VALUES(10, 3, 'Eduardo', 'Sampaio', 'Eduardo Sampaio', 'esampaio@vexcorp.com', NULL, true, true, false, false, '2010-11-16 12:43:11.0', '2010-11-16 12:43:11.0');
INSERT INTO public.people(id, people_type_id, first_name, last_name, full_name, email_address, birthday, enabled, visible, locked, deleted, created_at, updated_at)
  VALUES(6, 3, 'Leo', 'Watanabe', 'Leo Watanabe', 'leo.watanabe@accenture.com', NULL, true, true, false, false, '2010-11-16 00:41:08.0', '2010-11-16 00:41:08.0');
INSERT INTO public.people(id, people_type_id, first_name, last_name, full_name, email_address, birthday, enabled, visible, locked, deleted, created_at, updated_at)
  VALUES(7, 3, 'Fábio', 'Parrilha', 'Fábio Parrilha', 'fparrilha@yahoo.com.br', NULL, true, true, false, false, '2010-11-16 00:41:23.0', '2010-11-16 00:41:23.0');
INSERT INTO public.people(id, people_type_id, first_name, last_name, full_name, email_address, birthday, enabled, visible, locked, deleted, created_at, updated_at)
  VALUES(11, 3, 'Marcelo', 'Marcon', 'Marcelo Marcon', 'marcelomarcon@hotmail.com', NULL, true, true, false, false, '2010-11-16 12:43:52.0', '2010-11-16 12:43:52.0');
INSERT INTO public.people(id, people_type_id, first_name, last_name, full_name, email_address, birthday, enabled, visible, locked, deleted, created_at, updated_at)
  VALUES(12, 3, 'Renato', '', 'Renato', 'renato@gmail.com', NULL, true, true, false, false, '2010-11-16 12:44:14.0', '2010-11-16 12:44:14.0');
INSERT INTO public.people(id, people_type_id, first_name, last_name, full_name, email_address, birthday, enabled, visible, locked, deleted, created_at, updated_at)
  VALUES(13, 3, 'Vitor', '', 'Vitor', 'vitor@gmail.com', NULL, true, true, false, false, '2010-11-16 12:44:29.0', '2010-11-16 12:44:29.0');
INSERT INTO public.people(id, people_type_id, first_name, last_name, full_name, email_address, birthday, enabled, visible, locked, deleted, created_at, updated_at)
  VALUES(14, 3, 'Tio Rey', '', 'Tio Rey', 'tiorey@gmail.com', NULL, true, true, false, false, '2010-11-16 12:44:54.0', '2010-11-16 12:44:54.0');
INSERT INTO public.people(id, people_type_id, first_name, last_name, full_name, email_address, birthday, enabled, visible, locked, deleted, created_at, updated_at)
  VALUES(15, 3, 'Saichi', 'Okuma', 'Saichi Okuma', 'saichi.okuma@accenture.com', NULL, true, true, false, false, '2010-11-16 12:45:35.0', '2010-11-16 12:45:35.0');

INSERT INTO public.user_site(id, people_id, username, password, last_access_date, active, created_at, updated_at, enabled, visible, deleted, locked)
  VALUES(1, 1, 'lstegun', 'cf9991719a25bbd5c5bbd33ed79a83a6', NULL, true, '2010-11-16 00:38:31.0', '2010-11-16 00:38:31.0', true, true, false, false);

INSERT INTO public.ranking(id, ranking_name, user_site_id, ranking_type_id, start_date, finish_date, is_private, members, events, enabled, visible, locked, deleted, created_at, updated_at, default_buyin, game_style_id)
  VALUES(1, 'Poker friends - NLHE', 1, 12, '2010-01-01', NULL, true, 15, 17, true, true, false, false, '2010-11-16 00:38:51.0', '2010-11-17 00:24:16.0', 10.0, 8);
INSERT INTO public.ranking(id, ranking_name, user_site_id, ranking_type_id, start_date, finish_date, is_private, members, events, enabled, visible, locked, deleted, created_at, updated_at, default_buyin, game_style_id)
  VALUES(2, 'Poker friends - Ring', 1, 12, '2010-08-17', '2010-12-31', false, 8, 4, true, true, false, false, '2010-11-16 17:14:40.0', '2010-11-17 00:25:31.0', 10.0, 9);
INSERT INTO public.ranking(id, ranking_name, user_site_id, ranking_type_id, start_date, finish_date, is_private, members, events, enabled, visible, locked, deleted, created_at, updated_at, default_buyin, game_style_id)
  VALUES(3, NULL, 1, 12, NULL, NULL, false, 1, 0, false, false, false, false, '2010-11-17 00:21:48.0', '2010-11-17 00:21:48.0', 0.0, NULL);


INSERT INTO public.ranking_member(ranking_id, people_id, events, score, enabled, created_at, updated_at, balance, total_paid, total_prize)
  VALUES(1, 8, 1, 0.0, true, '2010-11-16 12:42:23.0', '2010-11-17 00:24:16.0', -10.0, 10.0, 0.0);
INSERT INTO public.ranking_member(ranking_id, people_id, events, score, enabled, created_at, updated_at, balance, total_paid, total_prize)
  VALUES(2, 1, 3, 7.0, true, '2010-11-16 17:14:40.0', '2010-11-17 00:25:31.0', 67.85, 30.0, 97.85);
INSERT INTO public.ranking_member(ranking_id, people_id, events, score, enabled, created_at, updated_at, balance, total_paid, total_prize)
  VALUES(2, 4, 3, 0.0, true, '2010-11-16 17:17:53.0', '2010-11-17 00:25:31.0', -44.0, 50.0, 6.0);
INSERT INTO public.ranking_member(ranking_id, people_id, events, score, enabled, created_at, updated_at, balance, total_paid, total_prize)
  VALUES(2, 2, 4, 3.0, true, '2010-11-16 17:17:25.0', '2010-11-17 00:25:31.0', 33.65, 60.0, 93.65);
INSERT INTO public.ranking_member(ranking_id, people_id, events, score, enabled, created_at, updated_at, balance, total_paid, total_prize)
  VALUES(2, 9, 1, 0.0, true, '2010-11-16 17:16:20.0', '2010-11-17 00:25:31.0', 5.5, 20.0, 25.5);
INSERT INTO public.ranking_member(ranking_id, people_id, events, score, enabled, created_at, updated_at, balance, total_paid, total_prize)
  VALUES(2, 3, 4, 3.0, true, '2010-11-16 17:16:31.0', '2010-11-17 00:25:31.0', 4.75, 37.0, 41.75);
INSERT INTO public.ranking_member(ranking_id, people_id, events, score, enabled, created_at, updated_at, balance, total_paid, total_prize)
  VALUES(1, 10, 1, 0.0, true, '2010-11-16 12:43:11.0', '2010-11-17 00:24:16.0', -10.0, 10.0, 0.0);
INSERT INTO public.ranking_member(ranking_id, people_id, events, score, enabled, created_at, updated_at, balance, total_paid, total_prize)
  VALUES(1, 7, 9, 5.0, true, '2010-11-16 00:41:23.0', '2010-11-17 00:24:16.0', -32.0, 100.0, 68.0);
INSERT INTO public.ranking_member(ranking_id, people_id, events, score, enabled, created_at, updated_at, balance, total_paid, total_prize)
  VALUES(1, 9, 2, 0.0, true, '2010-11-16 12:42:34.0', '2010-11-17 00:24:16.0', -20.0, 20.0, 0.0);
INSERT INTO public.ranking_member(ranking_id, people_id, events, score, enabled, created_at, updated_at, balance, total_paid, total_prize)
  VALUES(2, 7, 1, 0.0, true, '2010-11-16 17:16:52.0', '2010-11-17 00:25:31.0', -20.0, 20.0, 0.0);
INSERT INTO public.ranking_member(ranking_id, people_id, events, score, enabled, created_at, updated_at, balance, total_paid, total_prize)
  VALUES(1, 3, 15, 12.0, true, '2010-11-16 00:40:32.0', '2010-11-17 00:24:16.0', 45.0, 150.0, 195.0);
INSERT INTO public.ranking_member(ranking_id, people_id, events, score, enabled, created_at, updated_at, balance, total_paid, total_prize)
  VALUES(2, 5, 1, 0.0, true, '2010-11-16 17:17:02.0', '2010-11-17 00:25:31.0', -20.0, 20.0, 0.0);
INSERT INTO public.ranking_member(ranking_id, people_id, events, score, enabled, created_at, updated_at, balance, total_paid, total_prize)
  VALUES(1, 5, 11, 5.0, true, '2010-11-16 00:40:58.0', '2010-11-17 00:24:16.0', -50.0, 120.0, 70.0);
INSERT INTO public.ranking_member(ranking_id, people_id, events, score, enabled, created_at, updated_at, balance, total_paid, total_prize)
  VALUES(2, 6, 3, 3.0, true, '2010-11-16 17:17:12.0', '2010-11-17 00:25:31.0', -27.75, 50.0, 22.25);
INSERT INTO public.ranking_member(ranking_id, people_id, events, score, enabled, created_at, updated_at, balance, total_paid, total_prize)
  VALUES(1, 6, 13, 12.0, true, '2010-11-16 00:41:08.0', '2010-11-17 00:24:16.0', 45.0, 140.0, 185.0);
INSERT INTO public.ranking_member(ranking_id, people_id, events, score, enabled, created_at, updated_at, balance, total_paid, total_prize)
  VALUES(1, 1, 17, 7.0, true, '2010-11-16 00:38:51.0', '2010-11-17 00:24:16.0', -40.0, 150.0, 110.0);
INSERT INTO public.ranking_member(ranking_id, people_id, events, score, enabled, created_at, updated_at, balance, total_paid, total_prize)
  VALUES(1, 4, 14, 12.0, true, '2010-11-16 00:40:44.0', '2010-11-17 00:24:16.0', -10.0, 180.0, 170.0);
INSERT INTO public.ranking_member(ranking_id, people_id, events, score, enabled, created_at, updated_at, balance, total_paid, total_prize)
  VALUES(1, 2, 15, 16.0, true, '2010-11-16 00:40:22.0', '2010-11-17 00:24:16.0', 67.0, 170.0, 237.0);
INSERT INTO public.ranking_member(ranking_id, people_id, events, score, enabled, created_at, updated_at, balance, total_paid, total_prize)
  VALUES(1, 11, 2, 0.0, true, '2010-11-16 12:43:52.0', '2010-11-17 21:54:43.0', -20.0, 20.0, 0.0);
INSERT INTO public.ranking_member(ranking_id, people_id, events, score, enabled, created_at, updated_at, balance, total_paid, total_prize)
  VALUES(1, 12, 2, 0.0, true, '2010-11-16 12:44:14.0', '2010-11-17 21:54:45.0', -20.0, 20.0, 0.0);
INSERT INTO public.ranking_member(ranking_id, people_id, events, score, enabled, created_at, updated_at, balance, total_paid, total_prize)
  VALUES(1, 15, 4, 5.0, true, '2010-11-16 12:45:35.0', '2010-11-17 21:54:50.0', 40.0, 40.0, 80.0);
INSERT INTO public.ranking_member(ranking_id, people_id, events, score, enabled, created_at, updated_at, balance, total_paid, total_prize)
  VALUES(1, 14, 2, 4.0, true, '2010-11-16 12:44:55.0', '2010-11-17 21:54:55.0', 30.0, 20.0, 50.0);
INSERT INTO public.ranking_member(ranking_id, people_id, events, score, enabled, created_at, updated_at, balance, total_paid, total_prize)
  VALUES(1, 13, 2, 0.0, true, '2010-11-16 12:44:29.0', '2010-11-17 21:55:02.0', -20.0, 20.0, 0.0);
INSERT INTO public.ranking_member(ranking_id, people_id, events, score, enabled, created_at, updated_at, balance, total_paid, total_prize)
  VALUES(3, 1, 0, 0.0, true, '2010-11-17 00:21:48.0', '2010-11-17 00:21:48.0', 0.0, 0.0, 0.0);


INSERT INTO public.event(id, ranking_id, event_name, event_place, paid_places, buyin, event_date, start_time, comments, sent_email, invites, members, enabled, visible, locked, deleted, created_at, updated_at, saved_result)
  VALUES(12, 1, 'Poker night - Game #1', 'Casa do Reynaldo', 2, 10.0, '2010-10-26', '20:00:00', NULL, NULL, 15, 6, true, true, false, false, '2010-11-16 13:03:48.0', '2010-11-16 14:46:45.0', true);
INSERT INTO public.event(id, ranking_id, event_name, event_place, paid_places, buyin, event_date, start_time, comments, sent_email, invites, members, enabled, visible, locked, deleted, created_at, updated_at, saved_result)
  VALUES(5, 1, 'Poker night - Game #1', 'Apê do Wagner', 3, 10.0, '2010-09-21', '20:00:00', NULL, NULL, 15, 7, true, true, false, false, '2010-11-16 12:51:31.0', '2010-11-16 14:36:57.0', true);
INSERT INTO public.event(id, ranking_id, event_name, event_place, paid_places, buyin, event_date, start_time, comments, sent_email, invites, members, enabled, visible, locked, deleted, created_at, updated_at, saved_result)
  VALUES(1, 1, 'Poker night - Game #1', 'Apê do Wagner', 3, 10.0, '2010-08-10', '20:00:00', NULL, NULL, 15, 9, true, true, false, false, '2010-11-16 12:47:45.0', '2010-11-17 00:13:55.0', true);
INSERT INTO public.event(id, ranking_id, event_name, event_place, paid_places, buyin, event_date, start_time, comments, sent_email, invites, members, enabled, visible, locked, deleted, created_at, updated_at, saved_result)
  VALUES(21, 2, 'Poker night - Game #2', 'Apê do Wagner', 3, 0.0, '2010-10-26', '21:30:00', NULL, NULL, 8, 5, true, true, false, false, '2010-11-16 17:24:19.0', '2010-11-17 00:16:42.0', true);
INSERT INTO public.event(id, ranking_id, event_name, event_place, paid_places, buyin, event_date, start_time, comments, sent_email, invites, members, enabled, visible, locked, deleted, created_at, updated_at, saved_result)
  VALUES(14, 1, 'Poker night - Game #1', 'Apê do Wagner', 2, 10.0, '2010-11-09', '20:00:00', NULL, NULL, 15, 6, true, true, false, false, '2010-11-16 13:05:11.0', '2010-11-16 14:48:01.0', true);
INSERT INTO public.event(id, ranking_id, event_name, event_place, paid_places, buyin, event_date, start_time, comments, sent_email, invites, members, enabled, visible, locked, deleted, created_at, updated_at, saved_result)
  VALUES(20, 2, 'Poker night - Game #2', 'Casa do Reynaldo', 4, 0.0, '2010-10-05', '21:30:00', NULL, NULL, 8, 6, true, true, false, false, '2010-11-16 17:20:28.0', '2010-11-17 00:15:04.0', true);
INSERT INTO public.event(id, ranking_id, event_name, event_place, paid_places, buyin, event_date, start_time, comments, sent_email, invites, members, enabled, visible, locked, deleted, created_at, updated_at, saved_result)
  VALUES(7, 1, 'Poker night - Game #1', 'Casa do Reynaldo', 3, 10.0, '2010-09-28', '20:00:00', NULL, NULL, 15, 7, true, true, false, false, '2010-11-16 12:54:11.0', '2010-11-16 14:42:15.0', true);
INSERT INTO public.event(id, ranking_id, event_name, event_place, paid_places, buyin, event_date, start_time, comments, sent_email, invites, members, enabled, visible, locked, deleted, created_at, updated_at, saved_result)
  VALUES(19, 2, 'Poker night - Game #2', 'Apê do Wagner', NULL, 0.0, '2010-09-08', '21:30:00', NULL, NULL, 8, 5, true, true, false, false, '2010-11-16 17:19:51.0', '2010-11-16 17:31:18.0', true);
INSERT INTO public.event(id, ranking_id, event_name, event_place, paid_places, buyin, event_date, start_time, comments, sent_email, invites, members, enabled, visible, locked, deleted, created_at, updated_at, saved_result)
  VALUES(16, 1, 'Poker night - Game #1', 'Apê do Luciano', 3, 10.0, '2010-11-23', '20:00:00', NULL, NULL, 15, 1, true, true, false, false, '2010-11-16 13:06:30.0', '2010-11-16 15:01:58.0', false);
INSERT INTO public.event(id, ranking_id, event_name, event_place, paid_places, buyin, event_date, start_time, comments, sent_email, invites, members, enabled, visible, locked, deleted, created_at, updated_at, saved_result)
  VALUES(13, 1, 'Poker night - Game #2', 'Casa do Reynaldo', 2, 10.0, '2010-10-26', '21:30:00', NULL, NULL, 15, 6, true, true, false, false, '2010-11-16 13:04:33.0', '2010-11-16 14:47:18.0', true);
INSERT INTO public.event(id, ranking_id, event_name, event_place, paid_places, buyin, event_date, start_time, comments, sent_email, invites, members, enabled, visible, locked, deleted, created_at, updated_at, saved_result)
  VALUES(2, 1, 'Poker night - Game #2', 'Apê do Wagner', 3, 10.0, '2010-08-10', '21:30:00', NULL, NULL, 15, 8, true, true, false, false, '2010-11-16 12:49:25.0', '2010-11-16 13:28:27.0', true);
INSERT INTO public.event(id, ranking_id, event_name, event_place, paid_places, buyin, event_date, start_time, comments, sent_email, invites, members, enabled, visible, locked, deleted, created_at, updated_at, saved_result)
  VALUES(18, 2, 'Poker night - Game #2', 'Apê do Wagner', NULL, 0.0, '2010-08-17', '21:30:00', NULL, NULL, 8, 4, true, true, false, false, '2010-11-16 17:18:04.0', '2010-11-16 17:32:31.0', true);
INSERT INTO public.event(id, ranking_id, event_name, event_place, paid_places, buyin, event_date, start_time, comments, sent_email, invites, members, enabled, visible, locked, deleted, created_at, updated_at, saved_result)
  VALUES(3, 1, 'Poker night - Game #1', 'Apê do Wagner', 3, 10.0, '2010-08-24', '20:00:00', NULL, NULL, 15, 8, true, true, false, false, '2010-11-16 12:50:26.0', '2010-11-16 13:32:35.0', true);
INSERT INTO public.event(id, ranking_id, event_name, event_place, paid_places, buyin, event_date, start_time, comments, sent_email, invites, members, enabled, visible, locked, deleted, created_at, updated_at, saved_result)
  VALUES(17, 1, 'Poker night - Game #2', 'Apê do Luciano', 3, 10.0, '2010-11-23', '21:30:00', NULL, NULL, 15, 1, true, true, false, false, '2010-11-16 13:07:29.0', '2010-11-16 15:02:12.0', false);
INSERT INTO public.event(id, ranking_id, event_name, event_place, paid_places, buyin, event_date, start_time, comments, sent_email, invites, members, enabled, visible, locked, deleted, created_at, updated_at, saved_result)
  VALUES(4, 1, 'Poker night - Game #2', 'Apê do Wagner', 3, 10.0, '2010-08-24', '21:30:00', NULL, NULL, 15, 8, true, true, false, false, '2010-11-16 12:51:05.0', '2010-11-16 14:34:52.0', true);
INSERT INTO public.event(id, ranking_id, event_name, event_place, paid_places, buyin, event_date, start_time, comments, sent_email, invites, members, enabled, visible, locked, deleted, created_at, updated_at, saved_result)
  VALUES(6, 1, 'Poker night - Game #2', 'Apê do Wagner', 3, 10.0, '2010-09-21', '21:30:00', NULL, NULL, 15, 7, true, true, false, false, '2010-11-16 12:52:14.0', '2010-11-16 14:39:10.0', true);
INSERT INTO public.event(id, ranking_id, event_name, event_place, paid_places, buyin, event_date, start_time, comments, sent_email, invites, members, enabled, visible, locked, deleted, created_at, updated_at, saved_result)
  VALUES(8, 1, 'Poker night - Game #2', 'Casa do Reynaldo', 3, 10.0, '2010-09-28', '21:30:00', NULL, NULL, 15, 7, true, true, false, false, '2010-11-16 12:56:58.0', '2010-11-16 14:43:05.0', true);
INSERT INTO public.event(id, ranking_id, event_name, event_place, paid_places, buyin, event_date, start_time, comments, sent_email, invites, members, enabled, visible, locked, deleted, created_at, updated_at, saved_result)
  VALUES(11, 1, 'Poker night - Game #2', 'Apê do Wagner', 3, 10.0, '2010-10-19', '21:30:00', NULL, NULL, 15, 8, true, true, false, false, '2010-11-16 13:03:01.0', '2010-11-16 14:44:59.0', true);
INSERT INTO public.event(id, ranking_id, event_name, event_place, paid_places, buyin, event_date, start_time, comments, sent_email, invites, members, enabled, visible, locked, deleted, created_at, updated_at, saved_result)
  VALUES(9, 1, 'Poker night - Game #1', 'Apê do Wagner', 3, 10.0, '2010-10-05', '20:00:00', NULL, NULL, 15, 7, true, true, false, false, '2010-11-16 12:58:28.0', '2010-11-16 14:44:01.0', true);
INSERT INTO public.event(id, ranking_id, event_name, event_place, paid_places, buyin, event_date, start_time, comments, sent_email, invites, members, enabled, visible, locked, deleted, created_at, updated_at, saved_result)
  VALUES(10, 1, 'Poker night - Game #1', 'Apê do Wagner', 3, 10.0, '2010-10-19', '20:00:00', NULL, NULL, 15, 8, true, true, false, false, '2010-11-16 13:02:24.0', '2010-11-16 14:45:49.0', true);
INSERT INTO public.event(id, ranking_id, event_name, event_place, paid_places, buyin, event_date, start_time, comments, sent_email, invites, members, enabled, visible, locked, deleted, created_at, updated_at, saved_result)
  VALUES(15, 1, 'Poker night - Game #2', 'Apê do Wagner', 2, 10.0, '2010-11-09', '21:30:00', NULL, NULL, 15, 6, true, true, false, false, '2010-11-16 13:05:38.0', '2010-11-17 21:55:01.0', true);

INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(7, 9, 10.0, 0.0, 0.0, 6, 0.0, true, '2010-11-16 12:56:54.0', '2010-11-16 14:42:15.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(7, 3, 10.0, 0.0, 0.0, 4, 0.0, true, '2010-11-16 12:56:54.0', '2010-11-16 14:42:15.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(7, 1, 10.0, 0.0, 0.0, 5, 0.0, true, '2010-11-16 12:56:54.0', '2010-11-16 14:42:15.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(7, 12, 10.0, 0.0, 0.0, 7, 0.0, true, '2010-11-16 12:56:54.0', '2010-11-16 14:42:15.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(7, 4, 10.0, 0.0, 0.0, 3, 15.0, true, '2010-11-16 12:56:54.0', '2010-11-16 14:42:15.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(7, 14, 10.0, 0.0, 0.0, 1, 35.0, true, '2010-11-16 12:56:54.0', '2010-11-16 14:42:15.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(7, 2, 10.0, 0.0, 0.0, 2, 20.0, true, '2010-11-16 12:56:54.0', '2010-11-16 14:42:15.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(8, 9, 10.0, 0.0, 0.0, 7, 0.0, true, '2010-11-16 12:57:43.0', '2010-11-16 14:43:05.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(8, 3, 10.0, 0.0, 0.0, 6, 0.0, true, '2010-11-16 12:57:43.0', '2010-11-16 14:43:05.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(8, 1, 10.0, 0.0, 0.0, 5, 0.0, true, '2010-11-16 12:57:43.0', '2010-11-16 14:43:05.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(8, 12, 10.0, 0.0, 0.0, 4, 0.0, true, '2010-11-16 12:57:43.0', '2010-11-16 14:43:05.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(8, 4, 10.0, 0.0, 0.0, 2, 20.0, true, '2010-11-16 12:57:43.0', '2010-11-16 14:43:05.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(8, 14, 10.0, 0.0, 0.0, 3, 15.0, true, '2010-11-16 12:57:43.0', '2010-11-16 14:43:05.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(8, 2, 10.0, 0.0, 0.0, 1, 35.0, true, '2010-11-16 12:57:43.0', '2010-11-16 14:43:05.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(9, 8, 10.0, 0.0, 0.0, 5, 0.0, true, '2010-11-16 13:02:21.0', '2010-11-16 14:44:01.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(9, 3, 10.0, 0.0, 0.0, 6, 0.0, true, '2010-11-16 13:02:21.0', '2010-11-16 14:44:01.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(9, 7, 10.0, 0.0, 0.0, 1, 35.0, true, '2010-11-16 13:02:21.0', '2010-11-16 14:44:01.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(9, 5, 10.0, 0.0, 0.0, 4, 0.0, true, '2010-11-16 13:02:21.0', '2010-11-16 14:44:01.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(9, 6, 10.0, 0.0, 0.0, 7, 0.0, true, '2010-11-16 13:02:21.0', '2010-11-16 14:44:01.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(9, 1, 10.0, 0.0, 0.0, 2, 20.0, true, '2010-11-16 13:02:21.0', '2010-11-16 14:44:01.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(9, 2, 10.0, 0.0, 0.0, 3, 15.0, true, '2010-11-16 13:02:21.0', '2010-11-16 14:44:01.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(15, 3, 10.0, 0.0, 0.0, 3, 0.0, true, '2010-11-16 13:05:55.0', '2010-11-16 14:48:44.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(15, 5, 10.0, 10.0, 0.0, 5, 0.0, true, '2010-11-16 13:05:55.0', '2010-11-16 14:48:44.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(21, 3, 10.0, 0.0, 0.0, 2, 24.0, true, '2010-11-16 17:24:41.0', '2010-11-16 17:26:40.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(15, 4, 10.0, 0.0, 0.0, 6, 0.0, true, '2010-11-16 13:05:55.0', '2010-11-16 14:48:44.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(15, 2, 10.0, 0.0, 0.0, 4, 0.0, true, '2010-11-16 13:05:55.0', '2010-11-16 14:48:44.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(15, 6, 10.0, 0.0, 0.0, 2, 25.0, true, '2010-11-16 13:05:55.0', '2010-11-16 14:49:18.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(15, 1, 10.0, 0.0, 0.0, 1, 45.0, true, '2010-11-16 13:05:55.0', '2010-11-16 14:49:18.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(18, 7, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 17:19:12.0', '2010-11-16 17:19:12.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(18, 5, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 17:19:12.0', '2010-11-16 17:19:12.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(18, 6, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 17:19:12.0', '2010-11-16 17:19:12.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(18, 1, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 17:19:12.0', '2010-11-16 17:19:12.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(19, 9, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 17:20:26.0', '2010-11-16 17:20:26.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(19, 7, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 17:20:26.0', '2010-11-16 17:20:26.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(19, 5, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 17:20:26.0', '2010-11-16 17:20:26.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(18, 3, 10.0, 0.0, 0.0, 3, 10.0, true, '2010-11-16 17:19:12.0', '2010-11-16 17:32:31.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(20, 9, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 17:24:10.0', '2010-11-16 17:24:10.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(18, 2, 10.0, 0.0, 0.0, 2, 18.5, true, '2010-11-16 17:19:12.0', '2010-11-16 17:32:31.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(18, 9, 10.0, 10.0, 0.0, 1, 25.5, true, '2010-11-16 17:19:12.0', '2010-11-16 17:32:39.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(18, 4, 10.0, 10.0, 0.0, 4, 6.0, true, '2010-11-16 17:19:12.0', '2010-11-16 17:32:39.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(20, 4, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 17:24:10.0', '2010-11-16 17:24:10.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(20, 3, 7.0, 0.0, 0.0, 4, 7.75, true, '2010-11-16 17:24:10.0', '2010-11-16 17:28:50.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(21, 9, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 17:24:41.0', '2010-11-16 17:24:41.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(21, 7, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 17:24:41.0', '2010-11-16 17:24:41.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(21, 5, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 17:24:41.0', '2010-11-16 17:24:41.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(21, 6, 10.0, 10.0, 0.0, 3, 10.0, true, '2010-11-16 17:24:41.0', '2010-11-16 17:26:40.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(21, 1, 10.0, 0.0, 0.0, 1, 36.0, true, '2010-11-16 17:24:41.0', '2010-11-16 17:26:40.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(21, 4, 10.0, 0.0, 0.0, 4, 0.0, true, '2010-11-16 17:24:41.0', '2010-11-16 17:26:40.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(21, 2, 10.0, 10.0, 0.0, 5, 0.0, true, '2010-11-16 17:24:41.0', '2010-11-16 17:26:40.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(20, 7, 10.0, 10.0, 0.0, 5, 0.0, true, '2010-11-16 17:24:10.0', '2010-11-17 00:15:04.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(20, 5, 10.0, 10.0, 0.0, 6, 0.0, true, '2010-11-16 17:24:10.0', '2010-11-17 00:15:04.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(20, 6, 10.0, 0.0, 0.0, 3, 12.25, true, '2010-11-16 17:24:10.0', '2010-11-17 00:15:04.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(20, 1, 10.0, 0.0, 0.0, 1, 40.85, true, '2010-11-16 17:24:10.0', '2010-11-17 00:15:04.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(20, 2, 10.0, 10.0, 0.0, 2, 26.15, true, '2010-11-16 17:24:10.0', '2010-11-17 00:15:04.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(19, 3, 10.0, 0.0, 0.0, 3, 0.0, true, '2010-11-16 17:20:26.0', '2010-11-16 17:31:18.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(19, 6, 10.0, 10.0, 0.0, 4, 0.0, true, '2010-11-16 17:20:26.0', '2010-11-16 17:31:18.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(19, 1, 10.0, 0.0, 0.0, 2, 21.0, true, '2010-11-16 17:20:26.0', '2010-11-16 17:31:18.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(19, 4, 10.0, 10.0, 0.0, 5, 0.0, true, '2010-11-16 17:20:26.0', '2010-11-16 17:31:18.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(19, 2, 10.0, 0.0, 0.0, 1, 49.0, true, '2010-11-16 17:20:26.0', '2010-11-16 17:31:18.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(16, 5, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:06:59.0', '2010-11-16 13:06:59.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(16, 6, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:06:59.0', '2010-11-16 13:06:59.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(16, 11, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:06:59.0', '2010-11-16 13:06:59.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(16, 12, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:06:59.0', '2010-11-16 13:06:59.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(16, 4, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:06:59.0', '2010-11-16 13:06:59.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(16, 15, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:06:59.0', '2010-11-16 13:06:59.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(16, 14, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:06:59.0', '2010-11-16 13:06:59.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(16, 13, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:06:59.0', '2010-11-16 13:06:59.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(16, 2, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:06:59.0', '2010-11-16 13:06:59.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(16, 1, 0.0, 0.0, 0.0, 0, 0.0, true, '2010-11-16 13:06:59.0', '2010-11-16 13:06:59.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(17, 8, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:07:49.0', '2010-11-16 13:07:49.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(17, 9, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:07:49.0', '2010-11-16 13:07:49.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(17, 3, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:07:49.0', '2010-11-16 13:07:49.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(17, 10, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:07:49.0', '2010-11-16 13:07:49.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(17, 7, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:07:49.0', '2010-11-16 13:07:49.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(17, 5, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:07:49.0', '2010-11-16 13:07:49.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(17, 6, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:07:49.0', '2010-11-16 13:07:49.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(17, 11, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:07:49.0', '2010-11-16 13:07:49.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(17, 12, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:07:49.0', '2010-11-16 13:07:49.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(17, 4, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:07:49.0', '2010-11-16 13:07:49.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(17, 15, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:07:49.0', '2010-11-16 13:07:49.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(17, 14, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:07:49.0', '2010-11-16 13:07:49.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(17, 13, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:07:49.0', '2010-11-16 13:07:49.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(17, 2, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:07:49.0', '2010-11-16 13:07:49.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(17, 1, 0.0, 0.0, 0.0, 0, 0.0, true, '2010-11-16 13:07:49.0', '2010-11-16 13:07:54.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(1, 4, 10.0, 10.0, 0.0, 3, 20.0, true, '2010-11-16 12:48:57.0', '2010-11-16 13:18:57.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(1, 7, 10.0, 0.0, 0.0, 6, 0.0, true, '2010-11-16 12:48:57.0', '2010-11-16 13:20:18.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(1, 5, 10.0, 0.0, 0.0, 9, 0.0, true, '2010-11-16 12:48:57.0', '2010-11-16 13:20:18.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(1, 6, 10.0, 0.0, 0.0, 7, 0.0, true, '2010-11-16 12:48:57.0', '2010-11-16 13:20:18.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(1, 1, 10.0, 0.0, 0.0, 8, 0.0, true, '2010-11-16 12:48:57.0', '2010-11-16 13:20:18.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(14, 4, 10.0, 0.0, 0.0, 6, 0.0, true, '2010-11-16 13:05:37.0', '2010-11-16 14:48:01.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(2, 2, 10.0, 0.0, 0.0, 1, 45.0, true, '2010-11-16 12:50:01.0', '2010-11-16 13:26:43.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(2, 7, 10.0, 0.0, 0.0, 5, 0.0, true, '2010-11-16 12:50:01.0', '2010-11-16 13:28:27.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(2, 5, 10.0, 0.0, 0.0, 6, 0.0, true, '2010-11-16 12:50:01.0', '2010-11-16 13:28:27.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(14, 2, 10.0, 0.0, 0.0, 2, 25.0, true, '2010-11-16 13:05:37.0', '2010-11-16 14:48:01.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(2, 1, 10.0, 0.0, 0.0, 4, 0.0, true, '2010-11-16 12:50:01.0', '2010-11-16 13:28:27.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(2, 3, 10.0, 0.0, 0.0, 2, 30.0, true, '2010-11-16 12:50:01.0', '2010-11-16 13:29:02.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(2, 6, 10.0, 0.0, 0.0, 3, 15.0, true, '2010-11-16 12:50:01.0', '2010-11-16 13:29:02.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(2, 4, 10.0, 10.0, 0.0, 7, 0.0, true, '2010-11-16 12:50:01.0', '2010-11-16 13:29:02.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(2, 15, 10.0, 0.0, 0.0, 8, 0.0, true, '2010-11-16 12:50:01.0', '2010-11-16 13:29:02.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(3, 3, 10.0, 0.0, 0.0, 6, 0.0, true, '2010-11-16 12:51:04.0', '2010-11-16 13:32:35.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(3, 7, 10.0, 0.0, 0.0, 4, 0.0, true, '2010-11-16 12:51:04.0', '2010-11-16 13:32:35.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(3, 5, 10.0, 0.0, 0.0, 8, 0.0, true, '2010-11-16 12:51:04.0', '2010-11-16 13:32:35.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(3, 6, 10.0, 10.0, 0.0, 2, 30.0, true, '2010-11-16 12:51:04.0', '2010-11-16 13:32:35.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(3, 1, 10.0, 0.0, 0.0, 3, 20.0, true, '2010-11-16 12:51:04.0', '2010-11-16 13:32:35.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(3, 4, 10.0, 10.0, 0.0, 7, 0.0, true, '2010-11-16 12:51:04.0', '2010-11-16 13:32:35.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(3, 15, 10.0, 0.0, 0.0, 1, 50.0, true, '2010-11-16 12:51:04.0', '2010-11-16 13:32:35.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(3, 2, 10.0, 0.0, 0.0, 5, 0.0, true, '2010-11-16 12:51:04.0', '2010-11-16 13:32:35.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(4, 3, 10.0, 0.0, 0.0, 1, 45.0, true, '2010-11-16 12:51:25.0', '2010-11-16 14:34:52.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(4, 7, 10.0, 0.0, 0.0, 3, 18.0, true, '2010-11-16 12:51:25.0', '2010-11-16 14:34:52.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(4, 5, 10.0, 0.0, 0.0, 7, 0.0, true, '2010-11-16 12:51:25.0', '2010-11-16 14:34:52.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(4, 6, 10.0, 0.0, 0.0, 4, 0.0, true, '2010-11-16 12:51:25.0', '2010-11-16 14:34:52.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(4, 1, 10.0, 0.0, 0.0, 6, 0.0, true, '2010-11-16 12:51:25.0', '2010-11-16 14:34:52.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(4, 4, 10.0, 10.0, 0.0, 5, 0.0, true, '2010-11-16 12:51:25.0', '2010-11-16 14:34:52.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(4, 15, 10.0, 0.0, 0.0, 8, 0.0, true, '2010-11-16 12:51:25.0', '2010-11-16 14:34:52.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(4, 2, 10.0, 10.0, 0.0, 2, 27.0, true, '2010-11-16 12:51:25.0', '2010-11-16 14:34:52.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(5, 3, 10.0, 0.0, 0.0, 2, 20.0, true, '2010-11-16 12:52:09.0', '2010-11-16 14:36:56.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(5, 7, 10.0, 0.0, 0.0, 6, 0.0, true, '2010-11-16 12:52:09.0', '2010-11-16 14:36:56.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(5, 6, 10.0, 0.0, 0.0, 1, 35.0, true, '2010-11-16 12:52:09.0', '2010-11-16 14:36:56.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(5, 1, 10.0, 0.0, 0.0, 4, 0.0, true, '2010-11-16 12:52:09.0', '2010-11-16 14:36:56.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(5, 4, 10.0, 0.0, 0.0, 3, 15.0, true, '2010-11-16 12:52:09.0', '2010-11-16 14:36:57.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(5, 13, 10.0, 0.0, 0.0, 7, 0.0, true, '2010-11-16 12:52:09.0', '2010-11-16 14:36:57.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(5, 2, 10.0, 0.0, 0.0, 5, 0.0, true, '2010-11-16 12:52:09.0', '2010-11-16 14:36:57.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(6, 3, 10.0, 0.0, 0.0, 4, 0.0, true, '2010-11-16 12:52:32.0', '2010-11-16 14:39:10.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(6, 6, 10.0, 0.0, 0.0, 3, 15.0, true, '2010-11-16 12:52:32.0', '2010-11-16 14:39:10.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(6, 1, 10.0, 0.0, 0.0, 2, 25.0, true, '2010-11-16 12:52:32.0', '2010-11-16 14:39:10.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(6, 4, 10.0, 0.0, 0.0, 1, 40.0, true, '2010-11-16 12:52:32.0', '2010-11-16 14:39:10.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(6, 13, 10.0, 0.0, 0.0, 7, 0.0, true, '2010-11-16 12:52:32.0', '2010-11-16 14:39:10.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(6, 2, 10.0, 0.0, 0.0, 5, 0.0, true, '2010-11-16 12:52:32.0', '2010-11-16 14:39:10.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(6, 7, 10.0, 10.0, 0.0, 6, 0.0, true, '2010-11-16 12:52:32.0', '2010-11-16 14:41:22.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(8, 7, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:57:43.0', '2010-11-16 12:57:43.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(8, 5, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:57:43.0', '2010-11-16 12:57:43.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(8, 6, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:57:43.0', '2010-11-16 12:57:43.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(8, 11, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:57:43.0', '2010-11-16 12:57:43.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(10, 3, 10.0, 0.0, 0.0, 8, 0.0, true, '2010-11-16 13:02:56.0', '2010-11-16 14:45:48.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(8, 15, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:57:43.0', '2010-11-16 12:57:43.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(10, 7, 10.0, 0.0, 0.0, 3, 15.0, true, '2010-11-16 13:02:56.0', '2010-11-16 14:45:48.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(8, 13, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:57:43.0', '2010-11-16 12:57:43.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(10, 5, 10.0, 0.0, 0.0, 1, 40.0, true, '2010-11-16 13:02:56.0', '2010-11-16 14:45:48.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(9, 9, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:02:21.0', '2010-11-16 13:02:21.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(9, 10, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:02:21.0', '2010-11-16 13:02:21.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(10, 6, 10.0, 0.0, 0.0, 7, 0.0, true, '2010-11-16 13:02:56.0', '2010-11-16 14:45:48.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(10, 1, 10.0, 0.0, 0.0, 4, 0.0, true, '2010-11-16 13:02:56.0', '2010-11-16 14:45:48.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(9, 11, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:02:21.0', '2010-11-16 13:02:21.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(9, 12, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:02:21.0', '2010-11-16 13:02:21.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(9, 4, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:02:21.0', '2010-11-16 13:02:21.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(9, 15, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:02:21.0', '2010-11-16 13:02:21.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(9, 14, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:02:21.0', '2010-11-16 13:02:21.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(9, 13, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:02:21.0', '2010-11-16 13:02:21.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(10, 11, 10.0, 0.0, 0.0, 6, 0.0, true, '2010-11-16 13:02:56.0', '2010-11-16 14:45:48.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(10, 8, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:02:56.0', '2010-11-16 13:02:56.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(10, 9, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:02:56.0', '2010-11-16 13:02:56.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(10, 10, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:02:56.0', '2010-11-16 13:02:56.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(10, 12, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:02:56.0', '2010-11-16 13:02:56.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(10, 15, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:02:56.0', '2010-11-16 13:02:56.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(10, 14, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:02:56.0', '2010-11-16 13:02:56.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(10, 13, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:02:56.0', '2010-11-16 13:02:56.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(11, 8, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:03:35.0', '2010-11-16 13:03:35.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(11, 9, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:03:35.0', '2010-11-16 13:03:35.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(11, 10, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:03:35.0', '2010-11-16 13:03:35.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(11, 12, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:03:35.0', '2010-11-16 13:03:35.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(11, 15, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:03:35.0', '2010-11-16 13:03:35.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(11, 14, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:03:35.0', '2010-11-16 13:03:35.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(11, 13, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:03:35.0', '2010-11-16 13:03:35.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(12, 8, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:04:18.0', '2010-11-16 13:04:18.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(12, 9, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:04:18.0', '2010-11-16 13:04:18.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(12, 10, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:04:18.0', '2010-11-16 13:04:18.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(12, 7, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:04:18.0', '2010-11-16 13:04:18.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(12, 11, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:04:18.0', '2010-11-16 13:04:18.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(12, 12, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:04:18.0', '2010-11-16 13:04:18.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(12, 15, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:04:18.0', '2010-11-16 13:04:18.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(12, 14, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:04:18.0', '2010-11-16 13:04:18.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(12, 13, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:04:18.0', '2010-11-16 13:04:18.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(13, 8, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:04:58.0', '2010-11-16 13:04:58.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(13, 9, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:04:58.0', '2010-11-16 13:04:58.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(13, 10, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:04:58.0', '2010-11-16 13:04:58.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(13, 7, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:04:58.0', '2010-11-16 13:04:58.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(13, 11, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:04:58.0', '2010-11-16 13:04:58.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(13, 12, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:04:58.0', '2010-11-16 13:04:58.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(13, 15, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:04:58.0', '2010-11-16 13:04:58.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(13, 14, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:04:58.0', '2010-11-16 13:04:58.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(13, 13, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:04:58.0', '2010-11-16 13:04:58.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(14, 8, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:05:37.0', '2010-11-16 13:05:37.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(14, 9, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:05:37.0', '2010-11-16 13:05:37.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(14, 10, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:05:37.0', '2010-11-16 13:05:37.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(14, 7, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:05:37.0', '2010-11-16 13:05:37.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(14, 11, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:05:37.0', '2010-11-16 13:05:37.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(14, 12, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:05:37.0', '2010-11-16 13:05:37.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(14, 15, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:05:37.0', '2010-11-16 13:05:37.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(14, 14, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:05:37.0', '2010-11-16 13:05:37.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(14, 13, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:05:37.0', '2010-11-16 13:05:37.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(15, 8, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:05:55.0', '2010-11-16 13:05:55.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(15, 9, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:05:55.0', '2010-11-16 13:05:55.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(15, 10, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:05:55.0', '2010-11-16 13:05:55.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(15, 7, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:05:55.0', '2010-11-16 13:05:55.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(16, 8, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:06:59.0', '2010-11-16 13:06:59.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(16, 9, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:06:59.0', '2010-11-16 13:06:59.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(16, 3, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:06:59.0', '2010-11-16 13:06:59.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(16, 10, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:06:59.0', '2010-11-16 13:06:59.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(16, 7, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:06:59.0', '2010-11-16 13:06:59.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(2, 8, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:50:01.0', '2010-11-16 12:50:01.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(2, 9, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:50:01.0', '2010-11-16 12:50:01.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(10, 2, 10.0, 0.0, 0.0, 5, 0.0, true, '2010-11-16 13:02:56.0', '2010-11-16 14:45:49.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(2, 10, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:50:01.0', '2010-11-16 12:50:01.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(12, 3, 10.0, 0.0, 0.0, 1, 40.0, true, '2010-11-16 13:04:18.0', '2010-11-16 14:46:45.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(12, 5, 10.0, 0.0, 0.0, 4, 0.0, true, '2010-11-16 13:04:18.0', '2010-11-16 14:46:45.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(2, 11, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:50:01.0', '2010-11-16 12:50:01.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(2, 12, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:50:01.0', '2010-11-16 12:50:01.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(12, 6, 10.0, 0.0, 0.0, 6, 0.0, true, '2010-11-16 13:04:18.0', '2010-11-16 14:46:45.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(2, 14, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:50:01.0', '2010-11-16 12:50:01.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(2, 13, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:50:01.0', '2010-11-16 12:50:01.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(3, 8, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:51:04.0', '2010-11-16 12:51:04.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(3, 9, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:51:04.0', '2010-11-16 12:51:04.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(12, 1, 10.0, 0.0, 0.0, 5, 0.0, true, '2010-11-16 13:04:18.0', '2010-11-16 14:46:45.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(3, 10, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:51:04.0', '2010-11-16 12:51:04.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(12, 4, 10.0, 0.0, 0.0, 3, 0.0, true, '2010-11-16 13:04:18.0', '2010-11-16 14:46:45.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(12, 2, 10.0, 0.0, 0.0, 2, 20.0, true, '2010-11-16 13:04:18.0', '2010-11-16 14:46:45.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(3, 11, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:51:04.0', '2010-11-16 12:51:04.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(3, 12, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:51:04.0', '2010-11-16 12:51:04.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(13, 3, 10.0, 0.0, 0.0, 4, 0.0, true, '2010-11-16 13:04:58.0', '2010-11-16 14:47:18.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(3, 14, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:51:04.0', '2010-11-16 12:51:04.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(3, 13, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:51:04.0', '2010-11-16 12:51:04.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(4, 8, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:51:25.0', '2010-11-16 12:51:25.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(4, 9, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:51:25.0', '2010-11-16 12:51:25.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(13, 5, 10.0, 0.0, 0.0, 5, 0.0, true, '2010-11-16 13:04:58.0', '2010-11-16 14:47:18.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(4, 10, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:51:25.0', '2010-11-16 12:51:25.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(13, 6, 10.0, 0.0, 0.0, 2, 20.0, true, '2010-11-16 13:04:58.0', '2010-11-16 14:47:18.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(13, 1, 10.0, 0.0, 0.0, 3, 0.0, true, '2010-11-16 13:04:58.0', '2010-11-16 14:47:18.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(4, 11, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:51:25.0', '2010-11-16 12:51:25.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(4, 12, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:51:25.0', '2010-11-16 12:51:25.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(13, 4, 10.0, 0.0, 0.0, 1, 40.0, true, '2010-11-16 13:04:58.0', '2010-11-16 14:47:18.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(4, 14, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:51:25.0', '2010-11-16 12:51:25.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(4, 13, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:51:25.0', '2010-11-16 12:51:25.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(5, 8, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:52:09.0', '2010-11-16 12:52:09.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(5, 9, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:52:09.0', '2010-11-16 12:52:09.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(13, 2, 10.0, 0.0, 0.0, 6, 0.0, true, '2010-11-16 13:04:58.0', '2010-11-16 14:47:18.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(5, 10, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:52:09.0', '2010-11-16 12:52:09.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(5, 5, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:52:09.0', '2010-11-16 12:52:09.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(14, 3, 10.0, 0.0, 0.0, 1, 45.0, true, '2010-11-16 13:05:37.0', '2010-11-16 14:48:01.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(5, 11, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:52:09.0', '2010-11-16 12:52:09.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(5, 12, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:52:09.0', '2010-11-16 12:52:09.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(14, 5, 10.0, 0.0, 0.0, 5, 0.0, true, '2010-11-16 13:05:37.0', '2010-11-16 14:48:01.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(5, 15, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:52:09.0', '2010-11-16 12:52:09.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(5, 14, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:52:09.0', '2010-11-16 12:52:09.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(14, 6, 10.0, 0.0, 0.0, 3, 0.0, true, '2010-11-16 13:05:37.0', '2010-11-16 14:48:01.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(6, 8, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:52:32.0', '2010-11-16 12:52:32.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(6, 9, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:52:32.0', '2010-11-16 12:52:32.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(6, 10, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:52:32.0', '2010-11-16 12:52:32.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(14, 1, 10.0, 0.0, 0.0, 4, 0.0, true, '2010-11-16 13:05:37.0', '2010-11-16 14:48:01.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(6, 5, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:52:32.0', '2010-11-16 12:52:32.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(1, 15, 10.0, 0.0, 0.0, 2, 30.0, true, '2010-11-16 12:48:57.0', '2010-11-16 13:18:57.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(1, 2, 10.0, 0.0, 0.0, 1, 50.0, true, '2010-11-16 12:48:57.0', '2010-11-16 13:18:57.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(1, 3, 10.0, 0.0, 0.0, 4, 0.0, true, '2010-11-16 12:48:57.0', '2010-11-16 13:20:18.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(1, 10, 10.0, 0.0, 0.0, 5, 0.0, true, '2010-11-16 12:48:57.0', '2010-11-16 13:20:18.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(11, 3, 10.0, 0.0, 0.0, 3, 15.0, true, '2010-11-16 13:03:35.0', '2010-11-16 14:44:59.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(6, 11, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:52:32.0', '2010-11-16 12:52:32.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(6, 12, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:52:32.0', '2010-11-16 12:52:32.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(6, 15, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:52:32.0', '2010-11-16 12:52:32.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(6, 14, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:52:32.0', '2010-11-16 12:52:32.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(11, 7, 10.0, 0.0, 0.0, 6, 0.0, true, '2010-11-16 13:03:35.0', '2010-11-16 14:44:59.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(7, 8, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:56:54.0', '2010-11-16 12:56:54.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(11, 5, 10.0, 0.0, 0.0, 2, 30.0, true, '2010-11-16 13:03:35.0', '2010-11-16 14:44:59.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(7, 10, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:56:54.0', '2010-11-16 12:56:54.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(7, 7, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:56:54.0', '2010-11-16 12:56:54.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(7, 5, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:56:54.0', '2010-11-16 12:56:54.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(7, 6, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:56:54.0', '2010-11-16 12:56:54.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(11, 6, 10.0, 0.0, 0.0, 1, 45.0, true, '2010-11-16 13:03:35.0', '2010-11-16 14:44:59.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(7, 11, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:56:54.0', '2010-11-16 12:56:54.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(11, 1, 10.0, 0.0, 0.0, 7, 0.0, true, '2010-11-16 13:03:35.0', '2010-11-16 14:44:59.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(7, 15, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:56:54.0', '2010-11-16 12:56:54.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(7, 13, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:56:54.0', '2010-11-16 12:56:54.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(11, 11, 10.0, 0.0, 0.0, 8, 0.0, true, '2010-11-16 13:03:35.0', '2010-11-16 14:44:59.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(8, 8, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:57:43.0', '2010-11-16 12:57:43.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(11, 4, 10.0, 0.0, 0.0, 4, 0.0, true, '2010-11-16 13:03:35.0', '2010-11-16 14:44:59.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(8, 10, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:57:43.0', '2010-11-16 12:57:43.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(15, 11, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:05:55.0', '2010-11-17 21:54:42.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(15, 12, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:05:55.0', '2010-11-17 21:54:44.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(15, 15, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:05:55.0', '2010-11-17 21:54:49.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(15, 14, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:05:55.0', '2010-11-17 21:54:54.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(15, 13, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 13:05:55.0', '2010-11-17 21:55:00.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(1, 8, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:48:57.0', '2010-11-16 12:48:57.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(1, 9, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:48:57.0', '2010-11-16 12:48:57.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(11, 2, 10.0, 10.0, 0.0, 5, 0.0, true, '2010-11-16 13:03:35.0', '2010-11-16 14:44:59.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(10, 4, 10.0, 0.0, 0.0, 2, 20.0, true, '2010-11-16 13:02:56.0', '2010-11-16 14:45:49.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(1, 11, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:48:57.0', '2010-11-16 12:48:57.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(1, 12, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:48:57.0', '2010-11-16 12:48:57.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(1, 14, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:48:57.0', '2010-11-16 12:48:57.0');
INSERT INTO public.event_member(event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, created_at, updated_at)
  VALUES(1, 13, 0.0, 0.0, 0.0, 0, 0.0, false, '2010-11-16 12:48:57.0', '2010-11-16 12:48:57.0');



SELECT SETVAL('event_seq', (SELECT MAX(id) FROM event));
SELECT SETVAL('ranking_seq', (SELECT MAX(id) FROM ranking));
SELECT SETVAL('people_seq', (SELECT MAX(id) FROM people));
SELECT SETVAL('user_site_seq', (SELECT MAX(id) FROM user_site));
SELECT SETVAL('virtual_table_seq', (SELECT MAX(id) FROM virtual_table));