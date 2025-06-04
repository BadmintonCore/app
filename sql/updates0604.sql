ALTER TABLE globalConfig MODIFY COLUMN value TEXT;
INSERT INTO globalConfig (attribute, value) VALUES
                                                ('FOOTER_INSTAGRAM_LINK', 'https://instagram.com'),
                                                ('FOOTER_TIKTOK_LINK', 'https://tiktok.com'),
                                                ('FOOTER_X_LINK', 'https://x.com'),
                                                ('FOOTER_FACEBOOK_LINK', 'https://facebook.com');