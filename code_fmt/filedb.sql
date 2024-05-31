DROP TABLE IF EXISTS srcfiles;
CREATE TABLE srcfiles (
  userid TEXT NOT NULL,
  projectid TEXT NOT NULL,
  srcfile TEXT NOT NULL,
  processed CHAR(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (userid, projectid, srcfile)
);
