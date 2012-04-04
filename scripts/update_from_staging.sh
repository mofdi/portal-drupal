mysqldump -u devel -pXYZ -h nerf.gbif.org drupal_w2 > ~/portal-drupal.dump
mysql -u root -e "drop database drupal; create database drupal"
mysql -u root drupal < portal-drupal.dump