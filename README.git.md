# Git Setup and Management Guide

This guide covers the complete Git workflow for this project, including initialization, configuration, and troubleshooting.

## Table of Contents

| Section & Subsections        | Description                          | Location                               |
| --------------------------- | ------------------------------------ | -------------------------------------- |
| **Initial Setup**           | First-time repository setup          | [Initial Setup](#initial-setup)        |
| └─ Git Configuration        | Basic git config settings            | [Git Config](#git-configuration)       |
| └─ Repository Init          | Creating the repository              | [Repository Init](#repository-init)     |
| **Branch Management**       | Working with branches                | [Branch Management](#branch-management) |
| **File Tracking**          | Managing tracked files               | [File Tracking](#file-tracking)        |
| **Pushing Changes**        | Uploading to remote repository       | [Pushing Changes](#pushing-changes)    |
| **Troubleshooting**        | Common issues and solutions          | [Troubleshooting](#troubleshooting)    |

## Initial Setup

### Git Configuration

```bash
# Configure Git (if not already done)
git config --global user.name "Your Name"
git config --global user.email "your.email@example.com"

# Set up buffer and timeout configurations (important for large pushes)
git config http.postBuffer 524288000
git config http.lowSpeedLimit 1000
git config http.lowSpeedTime 300
```

### Repository Init

```bash
# Initialize new repository
git init

# Add remote repository
git remote add origin https://github.com/chadzilla2080/posture_dev_test.git

# Verify remote
git remote -v
```

## Branch Management

```bash
# Create and switch to new branch
git checkout -b feature/docker-config

# Verify current branch
git branch

# List all branches
git branch -a
```

## File Tracking

### Essential Files to Track

```
.gitignore                   # Git ignore rules
.gitattributes              # Git attributes
README.md                   # Main documentation
README.prod.md              # Production setup guide
docker/prod/*               # Docker production configs
wp-content/themes/posture_cool_things/* # Theme files
```

### Adding Files

```bash
# Add all files
git add --all

# Or add specific files
git add .gitignore
git add docker/prod/
git add wp-content/themes/posture_cool_things/
```

### Creating Initial Commit

```bash
git commit -m "Initial commit with Docker configuration
- Add Docker production setup
- Add environment configuration
- Include documentation
- Add theme files"
```

## Pushing Changes

### First-time Push

```bash
# Push to remote with upstream tracking
git push -u origin feature/docker-config
```

### Subsequent Pushes

```bash
git push
```

## Troubleshooting

### Large File Push Issues

If you encounter push errors like:
```
error: RPC failed; curl 55 Failed sending data to the peer
send-pack: unexpected disconnect while reading sideband packet
```

Try these solutions:

1. **Increase Buffer Size and Timeout**
```bash
# Increase buffer size to 500MB
git config http.postBuffer 524288000

# Increase timeout
git config http.lowSpeedLimit 1000
git config http.lowSpeedTime 300
```

2. **Push with No Verify**
```bash
git push -u origin feature/docker-config --no-verify
```

3. **Enable Maximum Compression**
```bash
git config --global core.compression 9
```

### Repository Issues

If you need to start fresh:
```bash
# Remove existing git repository
rm -rf .git

# Start over
git init
git remote add origin https://github.com/chadzilla2080/posture_dev_test.git
```

### Verification Commands

```bash
# Check repository status
git status

# View tracked files
git ls-files

# Check remote configuration
git remote -v

# View branch information
git branch
```

## Best Practices

1. Always verify your branch before making changes
2. Use meaningful commit messages
3. Check git status before committing
4. Verify tracked files match .gitignore rules
5. Push regularly to avoid large uploads

## Quick Reference

### Common Commands
```bash
git status              # Check repository status
git branch             # Show current branch
git add --all          # Track all files
git commit -m "msg"    # Create commit
git push               # Upload changes
```

### Configuration Commands
```bash
git config --list      # View all settings
git remote -v          # View remote repositories
git ls-files          # List tracked files
``` 