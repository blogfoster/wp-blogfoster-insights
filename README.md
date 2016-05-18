# blogfoster insights wordpress.com plugin

This plugin integrates blogfoster insights into your Wordpress blog.

## Description

This Plugin integrates blogfoster Insights into your Wordpress blog. It
helps you to understand your blog better and helps blogfoster to choose the
best cooperations and campaigns for you. After you configured the plugin in the
settings section, blogfoster Insights starts to work.

## Installation

### Using The WordPress Dashboard

1. Navigate to the 'Add New' in the plugins dashboard
2. Search for 'blogfoster Insights'
3. Click 'Install Now'
4. Activate the plugin on the Plugin dashboard
5. Go to 'blogfoster Insights'

### Uploading in WordPress Dashboard

1. Create a `.zip` archive of the plugin (`make zip` in root directory)
2. Navigate to the 'Add New' in the plugins dashboard
3. Navigate to the 'Upload' area
4. Select `blogfoster-insights.zip` from your computer
5. Click 'Install Now'
6. Activate the plugin in the Plugin dashboard
7. Go to 'blogfoster Insights'

## Development

check all php files for correct syntax

```bash
make lint
```

create an archive of the plugin that can be uploaded

```bash
make zip
```

### docker-compose

- install docker and docker-compose
- run docker-compose commands to start the **wordpress** service

```bash
docker-compose pull
docker-compose build
docker-compose up -d
```

- wordpress should be available now at port **8080**
