FROM postgres:13.4-alpine

RUN apk --no-cache add curl git build-base curl-dev wget

# Copy postgres config file into container
COPY .docker/postgresql/postgresql.conf /etc/postgresql/postgresql.conf

# Override default postgres config file
CMD ["postgres", "-c", "config_file=/etc/postgresql/postgresql.conf"]