# blogfoster Insights WordPress plugin

This plugin integrates blogfoster Insights into your WordPress blog.

## Description

This plugin integrates blogfoster Insights into your WordPress blog. It
helps you to understand your blog and gives blogfoster the chance to offer you
the most suitable sponsored spots and campaigns. After you have configured the
plugin in the settings section, blogfoster Insights starts to work.

## Installation

### Uploading to the WordPress

1. [Download the `.zip` archive of the plugin from the releases page][001]
2. Navigate to the 'Add New' in the plugins dashboard
3. Navigate to the 'Upload' area
4. Select `wp-blogfoster-insights.zip` from your computer
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


<!-- Links -->

[001]: https://github.com/blogfoster/wp-blogfoster-insights/releases/latest
