FROM ubuntu:latest

WORKDIR /app

COPY . .

CMD ["docker compose up -d" ]