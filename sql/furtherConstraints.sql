ALTER TABLE account ADD CONSTRAINT UNIQUE (username);
ALTER TABLE account ADD CONSTRAINT UNIQUE (email);
ALTER TABLE account DROP newsletter;