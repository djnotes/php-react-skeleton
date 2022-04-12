FROM docker.io/library/fedora:35

RUN dnf update -y

RUN dnf -y install php nodejs npm



COPY . /app

WORKDIR /app

RUN npm install

CMD ["npm","start"]


