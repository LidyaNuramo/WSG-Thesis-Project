# WSG-Thesis-Project

Site located at: https://mytravelrental.com/

To commit changes SSH to VM and run: sudo git pull https://github.com/LidyaNuramo/WSG-Thesis-Project.git

To set up:
cd /opt/bitnami/apache2/htdocs 
sudo git init 
sudo git config --global --add safe.directory *
sudo git add . 
sudo git config --global user.email "lidyagnuramom@gmail.com" 
sudo git config --global user.name "LidyaNuramo" 
sudo git commit -m "initial commit" 
sudo git remote add origin https://github.com/LidyaNuramo/WSG-Thesis-Project.git
sudo git pull https://github.com/LidyaNuramo/WSG-Thesis-Project.git

To update:
cd /opt/bitnami/apache2/htdocs 
sudo git pull https://github.com/LidyaNuramo/WSG-Thesis-Project.git -allow-unrelated-histories 

Conflict:
sudo git pull https://github.com/LidyaNuramo/WSG-Thesis-Project.git --allow-unrelated-histories 

Allow Read+Write+Execute to directory:
sudo chmod -R a+rwx /opt/bitnami/apache2/htdocs