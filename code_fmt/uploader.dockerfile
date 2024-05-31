FROM ubuntu:22.04 as builder
WORKDIR /app
RUN mkdir files && apt-get update && env DEBIAN_FRONTEND=noninteractive apt-get install -y sqlite3 php && apt-get clean
COPY uploader.sh index.html queue.php show.php .
CMD [ "./uploader.sh" ]