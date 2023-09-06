FROM jenkins/jenkins:lts

USER root

# RUN commands

RUN apt-get update && apt-get install -y docker.io

# Configure Docker
RUN echo "DOCKER_OPTS='--insecure-registry=localhost:5000'" >> /etc/default/docker


# Add a Jenkins user to the docker group so that Jenkins can run Docker commands
RUN usermod -aG docker jenkins

# Set the default shell to bash
RUN echo "export SHELL=/bin/bash" >> /etc/profile

RUN chgrp jenkins /lib/systemd/system/docker.socket
RUN chmod g+w /lib/systemd/system/docker.socket

# Expose port 8080 so that Jenkins can be accessed from the host machine

RUN gpasswd -a jenkins docker

USER jenkins

EXPOSE 8080
