FROM ubuntu:22.04
WORKDIR /app
RUN mkdir files && apt-get update && env DEBIAN_FRONTEND=noninteractive apt-get install -y php highlight && apt-get clean
COPY gen.php.
CMD [ "php", "gen.php" ]