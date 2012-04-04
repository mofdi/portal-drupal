mysqldump -u drupal_w2_ro -pTRQm5lF2 -h nerf.gbif.org drupal_w2 > /tmp/portal-drupal.dump
mysql -u root -e "drop database drupal; create database drupal"
mysql -u root drupal < /tmp/portal-drupal.dump